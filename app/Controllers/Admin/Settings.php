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
            'location_text'     => 'Near Khatia / Kisli Gate, Kanha Tiger Reserve, MP',
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
            'notification_mail',
            'whatsapp_number',
            'helpline_phone',
        ];

        foreach ($settingsToUpdate as $key) {
            $val = $this->request->getPost($key);
            if ($val !== null) {
                $this->settingModel->setSetting($key, trim((string)$val));
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
