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

        // Enforce 404 if admin_enabled is not '1' in settings
        if (function_exists('is_admin_link_enabled') && !is_admin_link_enabled()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('The requested page was not found.');
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
