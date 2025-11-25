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
    $routes->get('users', 'Admin::showAccountsPage'); // URL: /admin/users maps to showAccountsPage
    $routes->get('accounts', 'Admin::showAccountsPage'); // URL: /admin/accounts (alias)
    $routes->get('accounts/delete/(:num)', 'Admin::deleteAccount/$1'); // Delete action

    // Admin -> Requests
    $routes->get('requests', 'Admin::showInquiriesPage');
});
