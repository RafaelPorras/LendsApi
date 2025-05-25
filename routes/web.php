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

$router->get('/lends', 'LendController@index');
$router->post('/lends', 'LendController@store');
$router->get('/lends/{id}', 'LendController@show');
$router->put('/lends/{id}', 'LendController@update');
$router->patch('/lends/{id}', 'LendController@update'); // Optional, if you want to allow partial updates
$router->delete('/lends/{id}', 'LendController@destroy');