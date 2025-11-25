<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Admin Routes
$routes->group('admin', function ($routes) {
    $routes->get('/', 'Admin::showDashboardPage');

    // Admin -> Users (Accounts)
    $routes->get('accounts', 'Admin::showAccountsPage'); // URL: /admin/accounts (alias)
    $routes->get('accounts/delete/(:num)', 'Admin::deleteAccount/$1'); // Delete action

    // Admin -> Requests
    $routes->get('requests', 'Admin::showInquiriesPage');
});
$routes->get('games', 'Home::games');
$routes->get('games', 'Shop::index');
$routes->get('shop', 'Shop::index');
$routes->get('accessories', 'Home::accessories');
$routes->get('support', 'Home::support');
$routes->get('about-us', 'Home::about'); // Links 'about-us' URL to 'about' method

// Auth & Features
$routes->get('moodboard', 'Home::moodboard');
$routes->get('roadmap', 'Home::roadmap');

// Admin (if previously added)
$routes->get('/admin/dashboard', 'Admin::showDashboardPage');

$routes->get('/login', 'Auth::showLoginPage');
$routes->post('/login', 'Auth::login');
$routes->post('/logout', 'Auth::logout');
$routes->get('/signup', 'Auth::showSignupPage');
$routes->post('/signup', 'Auth::signup');

$routes->post('admin/accounts/edit/(:num)', 'Admin::ajaxEditAccount/$1');
