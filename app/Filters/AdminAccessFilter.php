<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;

class AdminAccessFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (function_exists('is_admin_link_enabled') && !is_admin_link_enabled()) {
            throw PageNotFoundException::forPageNotFound('The requested page was not found.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
