<?php

use CodeIgniter\Router\RouteCollection;

// Frontend routes
$routes->get('/', 'Home::index');
$routes->get('safari', 'Safari::index');
$routes->get('accommodation', 'Accommodation::index');
$routes->get('gallery', 'Gallery::index');
$routes->get('contact', 'Contact::index');
$routes->post('contact/enquiry', 'Contact::enquiry');
$routes->post('safari/book', 'Safari::book');
$routes->post('accommodation/book', 'Accommodation::book');

// Admin Panel Routes
$routes->group('admin', function ($routes) {
    $routes->get('/', 'Admin\Auth::index');
    $routes->get('login', 'Admin\Auth::login');
    $routes->post('login', 'Admin\Auth::authenticate');
    $routes->get('logout', 'Admin\Auth::logout');
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    // Slider Manager
    $routes->get('slider', 'Admin\Slider::index');
    $routes->post('slider/save', 'Admin\Slider::save');
    $routes->post('slider/toggle/(:num)', 'Admin\Slider::toggle/$1');
    $routes->post('slider/delete/(:num)', 'Admin\Slider::deleteSlide/$1');

    // Site Content Manager
    $routes->get('content', 'Admin\Content::index');
    $routes->post('content/update', 'Admin\Content::update');
    $routes->post('safari-slides/save', 'Admin\Content::saveSafariSlide');
    $routes->post('safari-slides/toggle/(:num)', 'Admin\Content::toggleSafariSlide/$1');
    $routes->post('safari-slides/delete/(:num)', 'Admin\Content::deleteSafariSlide/$1');

    // Photo Gallery Manager
    $routes->get('gallery', 'Admin\Gallery::index');
    $routes->post('gallery/save', 'Admin\Gallery::save');
    $routes->post('gallery/delete/(:num)', 'Admin\Gallery::deleteItem/$1');

    // Enquiries Manager
    $routes->get('enquiries', 'Admin\Enquiries::index');
    $routes->post('enquiries/update-status', 'Admin\Enquiries::updateStatus');
    $routes->get('enquiries/export', 'Admin\Enquiries::export');

    // Settings
    $routes->get('settings', 'Admin\Settings::index');
    $routes->post('settings/update', 'Admin\Settings::update');
});

