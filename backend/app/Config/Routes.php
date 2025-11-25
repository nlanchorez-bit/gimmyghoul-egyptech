<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// --- Admin Routes ---
$routes->group('admin', function ($routes) {
    $routes->get('/', 'Admin::showDashboardPage');

    // Admin -> Users (Accounts)
    $routes->get('users', 'Admin::showAccountsPage');
    $routes->get('accounts', 'Admin::showAccountsPage');
    $routes->get('accounts/delete/(:num)', 'Admin::deleteAccount/$1');
    $routes->get('accounts', 'Admin::showAccountsPage'); // URL: /admin/accounts (alias)
    $routes->get('accounts/delete/(:num)', 'Admin::deleteAccount/$1'); // Delete action

    // Admin -> Requests
    $routes->get('requests', 'Admin::showInquiriesPage');
});

// --- Public Pages ---
$routes->get('games', 'Home::games');
$routes->get('games', 'Shop::index');
$routes->get('shop', 'Shop::index');
$routes->get('accessories', 'Home::accessories');
$routes->get('support', 'Home::support');
$routes->get('about-us', 'Home::about');

// --- Auth & Features ---
$routes->get('moodboard', 'Home::moodboard');
$routes->get('roadmap', 'Home::roadmap');

// --- Shop Actions ---
$routes->get('shop/upload', 'Shop::create');       // Show upload form
$routes->post('shop/store', 'Shop::store');        // Process upload
$routes->get('shop/delete/(:num)', 'Shop::delete/$1'); // Delete item

// FIX: Point this to Shop::details, not Products::details
$routes->get('product/(:segment)', 'Shop::details/$1');

// --- Checkout & Orders (Required for "Buy Now" button) ---
$routes->get('checkout/(:num)', 'Requests::checkout/$1');       // Show Checkout Page
$routes->post('requests/placeOrder', 'Requests::placeOrder');   // Process Order
$routes->get('requests/success', 'Requests::success');          // Success Page

// --- Admin Dashboard (Legacy/Duplicate route, kept for safety) ---
$routes->get('/admin/dashboard', 'Admin::showDashboardPage');

// --- Authentication ---
$routes->get('/login', 'Auth::showLoginPage');
$routes->post('/login', 'Auth::login');
$routes->post('/logout', 'Auth::logout');
$routes->get('/signup', 'Auth::showSignupPage');
$routes->post('/signup', 'Auth::signup');

$routes->post('admin/accounts/edit/(:num)', 'Admin::ajaxEditAccount/$1');
