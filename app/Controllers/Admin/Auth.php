<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController
{
    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // Enforce 404 if admin_enabled is not '1' in settings
        if (function_exists('is_admin_link_enabled') && !is_admin_link_enabled()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('The requested page was not found.');
        }
    }

    public function index(): RedirectResponse
    {
        if (session()->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/dashboard'));
        }
        return redirect()->to(base_url('admin/login'));
    }

    public function login(): string|RedirectResponse
    {
        if (session()->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/dashboard'));
        }

        helper(['form']);

        $data = [
            'metaTitle' => 'Admin Login — Kanha Kisli Holiday',
            'error'     => session()->getFlashdata('error'),
            'success'   => session()->getFlashdata('success'),
        ];

        return view('admin/auth/login', $data);
    }

    public function authenticate(): RedirectResponse
    {
        helper(['form']);

        $email    = trim((string)$this->request->getPost('email'));
        $password = (string)$this->request->getPost('password');

        $userModel = new \App\Models\UserModel();
        $user = $userModel->findByEmail($email);

        // Verify against database password hash or username match
        $isValid = false;
        if ($user && password_verify($password, $user['password'])) {
            $isValid = true;
        } elseif (($email === 'admin@kanhakisli.com' || $email === 'admin') && $password === 'admin123') {
            // Fallback for demo convenience
            $user = $userModel->first() ?? [
                'name'  => 'Rajesh Sharma',
                'role'  => 'General Manager',
                'email' => 'admin@kanhakisli.com',
            ];
            $isValid = true;
        }

        if ($isValid && $user) {
            session()->set([
                'admin_logged_in' => true,
                'admin_id'        => $user['id'] ?? 1,
                'admin_name'      => $user['name'],
                'admin_role'      => $user['role'],
                'admin_email'     => $user['email'],
                'logged_in_time'  => time(),
            ]);

            return redirect()->to(base_url('admin/dashboard'))->with(
                'success',
                'Welcome back, ' . esc($user['name']) . '! You have successfully logged in to the Kanha Kisli administration panel.'
            );
        }

        return redirect()->to(base_url('admin/login'))->withInput()->with(
            'error',
            'Invalid email or password. Please use credentials: admin@kanhakisli.com / admin123'
        );
    }

    public function logout(): RedirectResponse
    {
        session()->remove(['admin_logged_in', 'admin_name', 'admin_role', 'admin_email', 'logged_in_time']);
        session()->destroy();

        return redirect()->to(base_url('admin/login'))->with(
            'success',
            'You have been logged out safely.'
        );
    }
}
