<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->get('/signup', 'Home::signup');
$routes->get('/moodboard', 'Home::moodboard');
$routes->get('/roadmap', 'Home::roadmap');
