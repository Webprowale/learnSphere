<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/course', 'Home::course');
$routes->get('/contact', 'Home::contact');

$routes->get('/register', 'AuthController::index');
$routes->post('/register', 'AuthController::register');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::confirm_login');

$routes->group('/user', function ($routes) {
    $routes->get('', 'UserController::index');
    $routes->get('logout', 'AuthController::logout');
});

$routes->group('/tutor',function($routes){
     $routes->get('', 'CourseController::index');
     $routes->post('/create-course', 'CourseController::create_course');
     $routes->post('/create-lesson', 'CourseController::create_lesson');
     $routes->post('/create-quiz', 'CourseController::create_quiz');
     
});
