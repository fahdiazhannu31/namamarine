<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('/register', 'Home::register');
$routes->get('/', 'Users::index', ['filter' => 'login']);
$routes->get('/users', 'Users::index');
$routes->get('/listpackage', 'Users::listpackage', ['filter' => 'role:users']);
$routes->get('/detailpackage', 'Users::detailpackage', ['filter' => 'role:users']);
$routes->get('/aboutus', 'Users::aboutus');

$routes->get('/Admin', 'Admin::index', ['filter' => 'role:admin']);

$routes->post('/payments', 'PaymentController::create');
$routes->post('/payments/webhook/xendit', 'PaymentController::webhook');
$routes->get('/api/routes', 'Route::getRoutes');
$routes->get('/payment-success', 'PaymentController::success');
$routes->get('/payment-failure', 'PaymentController::failure');
$routes->post('/generate-qrcode', 'PaymentController::generateQR');
$routes->post('/validate-qrcode', 'PaymentController::validateQRCode');
$routes->get('/scan-qrcode', 'PaymentController::scanQRCode');
$routes->post('qrcode_scanner/attendance', 'PaymentController::validateQRCode');
