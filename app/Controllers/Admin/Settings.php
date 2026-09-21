<?php

namespace App\Controllers\Admin;

use App\Models\SettingModel;
use App\Models\UserModel;

class Settings extends AdminBaseController
{
    protected SettingModel $settingModel;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
        $this->userModel    = new UserModel();
    }

    public function index()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $defaults = [
            'site_name'         => 'Kanha Kisli Holiday Resort',
            'site_tagline'      => 'Discover the wild. Feel closer to nature.',
            'admin_email'       => 'admin@kanhakisli.com',
            'admin_enabled'     => '1',
            'auto_email_lead'   => '1',
            'notification_mail' => 'bookings@kanhakisliholiday.in',
            'whatsapp_number'   => '+91 94251 00000',
            'helpline_phone'    => '+91 94251 00000',
            'owner_phone'       => '+91 75667 89123',
            'location_text'     => 'Mukki Gate, Kanha National Park, Madhya Pradesh, India',
            'google_maps_embed' => 'https://maps.google.com/maps?q=Mukki+Gate,+Kanha+National+Park,+Madhya+Pradesh&t=&z=13&ie=UTF8&iwloc=&output=embed',
            'status'            => 'live',
        ];

        $dbSettings = $this->settingModel->getAllSettings();
        $settings   = array_merge($defaults, $dbSettings);

        $currentUser = null;
        $adminId = session()->get('admin_id');
        if ($adminId) {
            $currentUser = $this->userModel->find($adminId);
        }

        $data = array_merge($this->adminData, [
            'metaTitle'   => 'General Settings — Kanha Kisli Holiday Admin',
            'pageHeading' => 'General Settings & Admin Profile',
            'activeNav'   => 'settings',
            'settings'    => $settings,
            'currentUser' => $currentUser,
        ]);

        return view('admin/settings', $data);
    }

    public function update()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        // Update settings in database
        $settingsToUpdate = [
            'site_name',
            'site_tagline',
            'location_text',
            'google_maps_embed',
            'auto_email_lead',
            'notification_mail',
            'whatsapp_number',
            'helpline_phone',
            'owner_phone',
            'admin_enabled',
        ];

        foreach ($settingsToUpdate as $key) {
            $val = $this->request->getPost($key);
            if ($val !== null) {
                $trimmedVal = trim((string)$val);
                if ($key === 'google_maps_embed') {
                    $trimmedVal = parse_map_embed_url($trimmedVal);
                }
                $this->settingModel->setSetting($key, $trimmedVal);

                // Keep site_content in full sync
                $contentModel = new \App\Models\ContentModel();
                if ($key === 'helpline_phone') {
                    $contentModel->setContent('contact', 'info', 'phone_primary', $trimmedVal);
                } elseif ($key === 'owner_phone') {
                    $contentModel->setContent('contact', 'info', 'phone_owner', $trimmedVal);
                } elseif ($key === 'whatsapp_number') {
                    $contentModel->setContent('contact', 'info', 'whatsapp', $trimmedVal);
                } elseif ($key === 'location_text') {
                    $contentModel->setContent('contact', 'info', 'address', $trimmedVal);
                } elseif ($key === 'notification_mail') {
                    $contentModel->setContent('contact', 'info', 'email', $trimmedVal);
                } elseif ($key === 'google_maps_embed') {
                    $contentModel->setContent('contact', 'map', 'google_maps_embed', $trimmedVal);
                }
            }
        }

        // Admin Account details update
        $adminId = session()->get('admin_id');
        if ($adminId) {
            $user = $this->userModel->find($adminId);
            if ($user) {
                $userData = [];

                $name = trim((string)$this->request->getPost('admin_name'));
                if ($name !== '' && $name !== $user['name']) {
                    $userData['name'] = $name;
                    session()->set('admin_name', $name);
                }

                $email = trim((string)$this->request->getPost('admin_email'));
                if ($email !== '' && $email !== $user['email']) {
                    $userData['email'] = $email;
                    session()->set('admin_email', $email);
                    $this->settingModel->setSetting('admin_email', $email);
                }

                $newPassword     = (string)$this->request->getPost('new_password');
                $confirmPassword = (string)$this->request->getPost('confirm_password');

                if ($newPassword !== '') {
                    if ($newPassword !== $confirmPassword) {
                        session()->setFlashdata('error', 'New passwords do not match. Other settings saved.');
                        return redirect()->to(base_url('admin/settings'));
                    }
                    if (strlen($newPassword) < 6) {
                        session()->setFlashdata('error', 'Password must be at least 6 characters. Other settings saved.');
                        return redirect()->to(base_url('admin/settings'));
                    }
                    $userData['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
                }

                if (!empty($userData)) {
                    $this->userModel->update($adminId, $userData);
                }
            }
        }

        session()->setFlashdata('success', 'All system settings and administrator profile updated successfully!');
        return redirect()->to(base_url('admin/settings'));
    }

    public function testEmail()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $recipient = get_site_setting('notification_mail', 'bookings@kanhakisliholiday.in');
        $subject   = 'Test Email Notification — Kanha Kisli Holiday Admin';
        $body      = "<div style='font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 12px; overflow: hidden;'>
            <div style='background: #234B35; color: #ffffff; padding: 20px 24px;'>
                <h2 style='margin: 0; font-size: 18px;'>SMTP Test Email</h2>
                <p style='margin: 4px 0 0; font-size: 12px; opacity: 0.85;'>Kanha Kisli Holiday Portal Verification</p>
            </div>
            <div style='padding: 24px; font-size: 14px; line-height: 1.6; color: #333;'>
                <p>Hello Administrator,</p>
                <p>This is a test notification confirming that your email configuration and SMTP communication channels are working properly.</p>
                <div style='background: #f4f6f4; border-left: 4px solid #234B35; padding: 12px 16px; margin: 16px 0; font-size: 13px;'>
                    <strong>Target Recipient:</strong> {$recipient}<br>
                    <strong>Timestamp:</strong> " . date('Y-m-d H:i:s T') . "
                </div>
                <p style='color: #666; font-size: 12px; margin-top: 24px;'>Dispatched from Admin Panel &middot; Kanha Kisli Holiday Resort</p>
            </div>
        </div>";

        if (function_exists('send_mail_notification')) {
            $sent = send_mail_notification($subject, $body, null, null, true);
            if ($sent) {
                session()->setFlashdata('success', "Test email sent successfully to {$recipient}!");
            } else {
                session()->setFlashdata('error', "Could not send test email to {$recipient}. Please check SMTP configuration in app/Config/Email.php or mail server status.");
            }
        } else {
            session()->setFlashdata('error', 'Email notification service is not available.');
        }

        return redirect()->to(base_url('admin/settings'));
    }
}
