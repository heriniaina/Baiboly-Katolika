<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', '\Baiboly\Controllers\HomeController::index');

$routes->group('baiboly', ['namespace' => '\Baiboly\Controllers'], static function ($routes) {
    $routes->get('/', 'BaibolyController::index');
    $routes->get('pejy', 'BaibolyController::index');
    $routes->get('niova/(:num)', 'BaibolyController::niova/$1');
    $routes->get('fitadiavana', 'BaibolyController::search');
    $routes->get('search', 'BaibolyController::search');
    $routes->get('hamaky', 'BaibolyController::hamaky');
    $routes->get('tahiry', 'TahiryController::index', ['filter' => 'auth']);
    $routes->match(['get', 'post'], 'tahiry/create', 'TahiryController::create', ['filter' => 'auth']);
});


$routes->group('boky', ['namespace' => '\Baiboly\Controllers'], static function ($routes) {
    $routes->get('/', 'BokyController::index');
    $routes->get('(:num)', 'BokyController::showById/$1');
    $routes->get('(:segment)', 'BokyController::show/$1');
    $routes->get('(:segment)/(:num)', 'BokyController::toko/$1/$2');
    $routes->get('(:segment)/(:num)/(:segment)', 'BokyController::toko/$1/$2/$3');
    $routes->get('(:segment)/(:segment)', 'BokyController::andininy/$1/$2');

});