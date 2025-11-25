<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('games', 'Home::games');
$routes->get('accessories', 'Home::accessories');
$routes->get('support', 'Home::support');
$routes->get('about-us', 'Home::about'); // Links 'about-us' URL to 'about' method

// Auth & Features
$routes->get('login', 'Home::login');
$routes->get('signup', 'Home::signup');
$routes->get('moodboard', 'Home::moodboard');
$routes->get('roadmap', 'Home::roadmap');

// Admin (if previously added)
$routes->get('admin', 'Admin::index');
