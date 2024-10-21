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
    $routes->get('watch/(:num)', 'UserController::watchCourse/$1');
    $routes->get('logout', 'AuthController::logout');
    $routes->get('live-search', 'UserController::searchCourse');
    $routes->get('buy/(:num)', 'UserController::buyCourse/$1');
    $routes->get('payment/callback', 'UserController::callBack');
    
});

$routes->group('/control', ['filter' => 'tutor'], function($routes) {
    $routes->get( '/', 'TutorController::index');
    $routes->post( 'en', 'TutorController::createCourse');
    $routes->get('course', 'TutorController::course');
    $routes->get('edit-course/(:num)', 'TutorController::editCourse/$1');
    $routes->post('course-update/(:num)', 'TutorController::updateCourse/$1');
    $routes->get('delete-course/(:num)', 'TutorController::deleteCourse/$1');

    
    
    $routes->get( 'create-lesson', 'TutorController::lesson');
    $routes->post( 'less-create', 'TutorController::createLesson');
    $routes->get( 'lesson', 'TutorController::allLesson');
    $routes->get('edit-lesson/(:num)', 'TutorController::editLesson/$1');
    $routes->post('lesson-update/(:num)', 'TutorController::updateLesson/$1');
    $routes->get('delete-lesson/(:num)', 'TutorController::deleteLesson/$1');


    $routes->get( 'create-quiz', 'TutorController::quiz');
    $routes->post( 'quiz-create', 'TutorController::createQuiz');
    $routes->get( 'quiz', 'TutorController::allQuiz');
    $routes->get('edit-quiz/(:num)', 'TutorController::editQuiz/$1');
    $routes->post('quiz-update/(:num)', 'TutorController::updateQuiz/$1');
    $routes->get('delete-quiz/(:num)', 'TutorController::deleteQuiz/$1');


    $routes->get('logout', 'AuthController::logout');
});

