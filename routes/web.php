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
//     Route for fetching vehicles with modelYear, manufacturer and model sent in post variables
$router->post('vehicles','VehiclesController@vehicles');

//     Route for fetching vehicles with modelYear, manufacturer and model sent in Get URL and with or without Rating.
$router->get('vehicles/{modelyear}/{make}/{model}','VehiclesController@index');



