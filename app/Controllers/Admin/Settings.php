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
            'notification_mail' => 'bookings@kanhakisliholiday.com',
            'whatsapp_number'   => '+91 94251 00000',
            'helpline_phone'    => '+91 94251 00000',
            'owner_phone'       => '+91 75667 89123',
            'location_text'     => 'Near Khatia / Kisli Gate, Kanha Tiger Reserve, MP',
            'google_maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58728.89240410408!2d80.57500355!3d22.2858145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a2a68393693e507%3A0xc3d5d7e48ce19cf5!2sKanha%20Tiger%20Reserve%2C%20Khatia%20Gate!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin',
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
            'notification_mail',
            'whatsapp_number',
            'helpline_phone',
            'owner_phone',
        ];

        foreach ($settingsToUpdate as $key) {
            $val = $this->request->getPost($key);
            if ($val !== null) {
                $trimmedVal = trim((string)$val);
                if ($key === 'google_maps_embed') {
                    $trimmedVal = parse_map_embed_url($trimmedVal);
                }
                $this->settingModel->setSetting($key, $trimmedVal);

                // Keep site_content in sync
                if ($key === 'owner_phone') {
                    $contentModel = new \App\Models\ContentModel();
                    $contentModel->setContent('contact', 'info', 'phone_owner', $trimmedVal);
                } elseif ($key === 'google_maps_embed') {
                    $contentModel = new \App\Models\ContentModel();
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
}
