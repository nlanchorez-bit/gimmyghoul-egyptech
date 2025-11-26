<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// --- BUYER ROUTES (Public/User) ---
$routes->get('checkout/(:num)', 'Requests::checkout/$1');
$routes->post('requests/placeOrder', 'Requests::placeOrder');
$routes->get('requests/success', 'Requests::success');

// --- ADMIN ROUTES ---
$routes->group('admin', function ($routes) {
    $routes->get('/', 'Admin::showDashboardPage');

    // Admin -> Requests Management
    $routes->get('requests', 'Admin::showInquiriesPage');
    $routes->get('requests/approve/(:num)', 'Admin::approveRequest/$1'); // New
    $routes->get('requests/delete/(:num)', 'Admin::deleteRequest/$1');   // New

    // Admin -> Users
    $routes->get('users', 'Admin::showAccountsPage');
    $routes->get('accounts', 'Admin::showAccountsPage');
    $routes->get('accounts/delete/(:num)', 'Admin::deleteAccount/$1');
});

// --- Public Pages ---
$routes->get('games', 'Home::games');
$routes->get('games', 'Shop::index'); // Note: This overwrites the previous 'games' route
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
// Note: These were duplicated in your previous snippet, removed duplicates here.
// They are already defined at the top under "BUYER ROUTES".

// --- Admin Dashboard (Legacy/Duplicate route, kept for safety) ---
$routes->get('/admin/dashboard', 'Admin::showDashboardPage');

// Authentication
$routes->get('/login', 'Auth::showLoginPage');
$routes->post('/login', 'Auth::login');
$routes->post('/logout', 'Auth::logout');
$routes->get('/signup', 'Auth::showSignupPage');
$routes->post('/signup', 'Auth::signup');

// --- Product Reviews ---
$routes->post('reviews/submit', 'Reviews::submit');             // Submit a review
$routes->get('reviews/delete/(:num)', 'Reviews::delete/$1');    // Delete a review

// --- Product Reviews ---
$routes->post('reviews/add', 'Reviews::add');                   // Add new
$routes->post('reviews/edit/(:num)', 'Reviews::edit/$1');       // Edit existing (AJAX)
$routes->get('reviews/delete/(:num)', 'Reviews::delete/$1');    // Delete
