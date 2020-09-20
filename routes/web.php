<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');

    $router->get('profile', 'UserController@profile');
    $router->get('users/{id}', 'UserController@singleUser');
    $router->get('users', 'UserController@allUsers');

    $router->get('posts',  ['uses' => 'PostController@index']);
    $router->get('posts/{id}', ['uses' => 'PostController@show']);
    $router->post('posts', ['uses' => 'PostController@store']);
    $router->delete('posts/{id}', ['uses' => 'PostController@delete']);
    $router->put('posts/{id}', ['uses' => 'PostController@update']);

    $router->post('comments', ['uses' => 'CommentController@store']);
});
