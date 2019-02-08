<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function() {
    return str_random(32);
});

//for user registration
$router->post ('/newuser', 'UserCtrl@register');

//for user login
$router->post('login','AuthCtrl@authentication');

//for user logout
$router->get('logout/{id}','AuthCtrl@logout');

//for student registration
$router->post ('/student', 'StudentCtrl@reg_student');

//for photo upload
$router->post ('/photo', 'photoCtrl@image');