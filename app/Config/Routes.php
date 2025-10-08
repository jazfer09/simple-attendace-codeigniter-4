<?php
namespace Config;

$routes = Services::routes();

$routes->get('/', 'Home::index');
$routes->get('about-developer', 'Home::aboutDeveloper');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('logout', 'Auth::logout');

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->post('dashboard/punch', 'Dashboard::punch');
    $routes->get('profile', 'Profile::index');
    $routes->post('profile/change-password', 'Profile::changePassword');
});

$routes->group('', ['filter' => 'admin'], function($routes) {
    $routes->get('employees', 'Employees::index');
    $routes->post('employees/add', 'Employees::add');
    $routes->post('employees/delete/(:num)', 'Employees::delete/$1');
    $routes->get('reports', 'Reports::index');
    $routes->post('reports/generate', 'Reports::generate');
});