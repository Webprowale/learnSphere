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
    $routes->get('live-search', 'UserController::searchCourse');
    $routes->get('buy/(:num)', 'UserController::buy/$1');
});

$routes->group('/control', ['filter' => 'tutor'], function($routes) {
    $routes->get( '/', 'TutorController::index');
    $routes->post( 'en', 'TutorController::createCourse');
    $routes->get('course', 'TutorController::course');
    $routes->get('edit-course/(:num)', 'TutorController::editCourse/$1');
    $routes->post('course-update/(:num)', 'TutorController::updateCourse/$1');
    $routes->get('delete-course/(:num)', 'TutorController::deleteCourse/$1');

    
    
    $routes->get( 'create-lesson', 'TutorController::lesson');
    $routes->post( 'less-create', 'TutorController::create_lesson');
    $routes->get( 'lesson', 'TutorController::all_lesson');
    $routes->get('edit-lesson/(:num)', 'TutorController::edit_lesson/$1');
    $routes->post('lesson-update/(:num)', 'TutorController::update_lesson/$1');
    $routes->get('delete-lesson/(:num)', 'TutorController::delete_lesson/$1');

    $routes->get('logout', 'AuthController::logout');
});

