<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('admin', static function ($routes) {
    // route admin dashboard
    $routes->get('dashboard', 'Admin\DashboardController::index');

    // route admin product
    $routes->get('product-list', 'Admin\ProductController::index');
    $routes->get('product-list/add', 'Admin\ProductController::form_create');
    $routes->get('product-list/edit/(:num)', 'Admin\ProductController::form_update/$1');
    $routes->post('product-list/add/store', 'Admin\ProductController::store_product');
    $routes->put('product-list/edit/(:num)/update', 'Admin\ProductController::update_product/$1');
    $routes->delete('product-list/delete', 'Admin\ProductController::destroy_product');
    $routes->get('product-list/detail/(:num)', 'Admin\ProductController::detail_product/$1');

    // route admin category
    $routes->get('product-category', 'Admin\ProductController::category');
    $routes->post('product-category/store', 'Admin\ProductController::store');
    $routes->put('product-category/edit/(:num)', 'Admin\ProductController::update/$1');
    $routes->delete('product-category/delete/(:num)', 'Admin\ProductController::destroy/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
