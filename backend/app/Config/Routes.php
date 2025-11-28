<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home
$routes->get('/', 'Home::index');

// --- Public Pages ---
$routes->get('games', 'Shop::index');
$routes->get('shop', 'Shop::index');
$routes->get('accessories', 'Home::accessories');
$routes->get('support', 'Home::support');
$routes->get('about-us', 'Home::about');

// --- Auth & Features ---
$routes->get('login', 'Home::login');
$routes->get('signup', 'Home::signup');
$routes->get('moodboard', 'Home::moodboard');
$routes->get('roadmap', 'Home::roadmap');

// --- Profile Routes ---
$routes->get('profile', 'Home::profile');
$routes->post('profile/update', 'Home::updateProfile');
$routes->post('profile/upload-avatar', 'Home::uploadAvatar');

// --- SHOP / BUYER ACTIONS ---
$routes->get('product/(:segment)', 'Shop::details/$1');
$routes->get('shop/upload', 'Shop::create');
$routes->post('shop/store', 'Shop::store');
$routes->get('shop/delete/(:num)', 'Shop::delete/$1');

$routes->get('checkout/(:num)', 'Requests::checkout/$1');
$routes->post('requests/placeOrder', 'Requests::placeOrder');
$routes->get('requests/success', 'Requests::success');

// --- AUTHENTICATION ---
$routes->get('/login', 'Auth::showLoginPage');
$routes->post('/login', 'Auth::login');
$routes->post('/logout', 'Auth::logout');
$routes->get('/signup', 'Auth::showSignupPage');
$routes->post('/signup', 'Auth::signup');

// --- ADMIN ROUTES ---
$routes->group('admin', function ($routes) {
    $routes->get('/', 'Admin::showDashboardPage');
    $routes->get('dashboard', 'Admin::showDashboardPage');

    $routes->get('products', 'Admin::showProductsPage');

    $routes->get('requests', 'Admin::showInquiriesPage');
    $routes->get('requests/approve/(:num)', 'Admin::approveRequest/$1');
    $routes->get('requests/delete/(:num)', 'Admin::deleteRequest/$1');

    $routes->get('users', 'Admin::showAccountsPage');
    $routes->get('accounts', 'Admin::showAccountsPage');
    $routes->get('accounts/delete/(:num)', 'Admin::deleteAccount/$1');
    $routes->get('accounts/edit/(:num)', 'Admin::editAccount/$1');
    $routes->post('accounts/edit/(:num)', 'Admin::updateAccount/$1');
});

// --- REVIEWS ---
$routes->post('reviews/submit', 'Reviews::submit');
$routes->post('reviews/add', 'Reviews::add');
$routes->post('reviews/edit/(:num)', 'Reviews::edit/$1');
$routes->get('reviews/delete/(:num)', 'Reviews::delete/$1');

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
