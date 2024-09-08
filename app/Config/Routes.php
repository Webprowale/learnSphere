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

// Auth
$routes->post('/reg', 'AuthController::register');
$routes->post('/log', 'AuthController::confirm_login');

$routes->group('/user', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'UserController::index');
    $routes->get('logout', 'AuthController::logout');
    $routes->get('buy', 'UserController::buy');
});

$routes->group('/tutor',function($routes){
     $routes->get('', 'CourseController::index');
     $routes->post('/create-course', 'CourseController::create_course');
     $routes->post('/create-lesson', 'CourseController::create_lesson');
     $routes->post('/create-quiz', 'CourseController::create_quiz');
     
});
