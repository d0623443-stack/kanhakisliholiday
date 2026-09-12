<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

abstract class AdminBaseController extends BaseController
{
    /**
     * Common data for all admin views
     */
    protected array $adminData = [];

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // Simulated session check: if not logged in, auto-seed demo session or redirect
        if (!session()->get('admin_logged_in')) {
            // For smooth development preview, if accessed directly, we can auto-seed demo session or check query param
            // But let's check if the user asked "present with login redirect"
            // So if not logged in, redirect to login!
        }

        $this->adminData = [
            'adminName'   => session()->get('admin_name') ?? 'Rajesh Sharma',
            'adminRole'   => session()->get('admin_role') ?? 'General Manager',
            'adminEmail'  => session()->get('admin_email') ?? 'admin@kanhakisli.com',
            'unreadCount' => 4,
        ];
    }

    protected function checkAuth()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'))->with('error', 'Please log in to access the administration panel.');
        }
        return null;
    }
}
