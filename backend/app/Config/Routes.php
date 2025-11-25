<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
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
$routes->get('admin', 'Admin::index');

$routes->get('/login', 'Auth::showLoginPage');
$routes->post('/login', 'Auth::login');
$routes->post('/logout', 'Auth::logout');
$routes->get('/signup', 'Auth::showSignupPage');
$routes->post('/signup', 'Auth::signup');
