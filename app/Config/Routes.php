<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', function () {
    $data = [
        'title' => "Blog - Home"
    ];
    echo view('layout/header', $data);
    echo view('layout/navbar');
    echo view('v_home');
    echo view('layout/footer');
});

$routes->get('/register', 'Template::register');
$routes->post('/saveRegister', 'Template::saveRegister');
//dia menggunakan post karena disesuaikan dengan method pada v_register
$routes->get('/posts', 'PostController::index');
$routes->get('/about', function () {
    $data = [
        'title' => "Blog - About"
    ];
    echo view('layout/header', $data);
    echo view('layout/navbar');
    echo view('v_about');
    echo view('layout/footer');
});

$routes->get('/admin', 'Template::index');
$routes->get('/admin/posts', 'AdminPostController::index');
$routes->get('/admin/posts/create', 'AdminPostController::create');
$routes->post('/admin/posts/store', 'AdminPostController::store');
$routes->delete('/admin/posts/(:any)', 'AdminPostController::delete/$1');
$routes->get('/admin/posts/edit/(:any)', 'AdminPostController::edit/$1');
$routes->post('/admin/posts/update/(:any)', 'AdminPostController::update/$1');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
