<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/course', 'Home::course');
$routes->get('/contact', 'Home::contact');
$routes->get('/login', 'Home::login');
$routes->get('/register', 'Home::register');
$routes->get('/register/tutor', 'Home::Tutor');

// Auth
$routes->post('/reg', 'AuthController::register');
$routes->post('/log', 'AuthController::confirm_login');

$routes->group('/user', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'UserController::index');
    $routes->get('logout', 'AuthController::logout');
    $routes->get('buy', 'UserController::buy');
});

$routes->group('/control', ['filter' => 'tutor'], function($routes) {
    $routes->get( '/', 'TutorController::index');
    $routes->post( 'en', 'TutorController::create_course');
    $routes->get('course', 'TutorController::course');
    $routes->get( 'create-lesson', 'TutorController::lesson');
    $routes->post( 'less-create', 'TutorController::create_lesson');
    $routes->get( 'lesson', 'TutorController::all_lesson');
    $routes->get('logout', 'AuthController::logout');
});

