<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('keranjang', 'Keranjang::index');
$routes->post('tambahKeKeranjang/(:segment)', 'Keranjang::tambahKeKeranjang/$1');
$routes->get('Keranjang/delete/(:num)', 'Keranjang::delete/$1');
$routes->get('/Keranjang/checkout', 'Keranjang::checkout');



