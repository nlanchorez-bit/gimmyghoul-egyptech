<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('games', 'Home::games');
$routes->get('games', 'Shop::index'); // Note: This overwrites the previous 'games' route
$routes->get('shop', 'Shop::index');
$routes->get('accessories', 'Home::accessories');
$routes->get('support', 'Home::support');
$routes->get('about-us', 'Home::about'); // Links 'about-us' URL to 'about' method

// Auth & Features
$routes->get('moodboard', 'Home::moodboard');
$routes->get('roadmap', 'Home::roadmap');

// Admin (if previously added)
$routes->get('/admin/dashboard', 'Admin::showDashboardPage');

// Authentication
$routes->get('/login', 'Auth::showLoginPage');
$routes->post('/login', 'Auth::login');
$routes->post('/logout', 'Auth::logout');
$routes->get('/signup', 'Auth::showSignupPage');
$routes->post('/signup', 'Auth::signup');


// --- NEW ROUTES FOR RETROCRYPT FEATURES ---

// 1. Product Catalog (The detailed view we built)
$routes->get('products', 'Products::index');
$routes->get('products/search', 'Products::search');
$routes->get('products/details/(:segment)', 'Products::details/$1'); // View Product by slug

// 2. Order & Checkout
$routes->get('checkout/(:num)', 'Requests::checkout/$1');       // Show Checkout Page (by Product ID)
$routes->post('requests/placeOrder', 'Requests::placeOrder');   // Process the Order
$routes->get('requests/success', 'Requests::success');          // Success Page

// 3. Product Reviews
$routes->post('reviews/submit', 'Reviews::submit');             // Submit a review
$routes->get('reviews/delete/(:num)', 'Reviews::delete/$1');    // Delete a review