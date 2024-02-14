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
$routes->setDefaultController('Employee');
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
//admin page routes ///////////////////////////////////////////////////////
$routes->add('admin/delete/(:num)', 'Dashboard::deletedata/$1');
$routes->add('admin/edit/(:num)', 'Dashboard::editdata/$1');
$routes->add('admin/update/(:num)', 'Dashboard::updatedata/$1');
$routes->add('admin/dashboard', 'Dashboard::index');
$routes->add('admin/list', 'Dashboard::Companylist');
$routes->add('admin/addcompany', 'Dashboard::Adddata');
$routes->add('admin/insert', 'Dashboard::insertdata');
$routes->add('admin/employee', 'Dashboard::employeedata');
$routes->add('admin/logout', 'Dashboard::adminlogout');
$routes->get('admin', 'Login::index');
$routes->add('validate', 'Login::adminlogin');

//user page routes//////////////////////////////////////////////////////////
$routes->add('signature', 'Employee::employeeinsert');
$routes->add('fetchdata', 'Employee::displaypreview');




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
