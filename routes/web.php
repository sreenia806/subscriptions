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


$router->group(['prefix' => 'api/'], function ($app) {
    $app->post('login/','UserController@authenticate')->name('authenticate');
    //$app->post('plans/','PlanController@store');
    $app->get('plans/', 'PlanController@index')->name('plans');
    $app->get('plans/{code}/', 'PlanController@show')->name('plan.show');
    $app->post('subscriptions/preview', 'SubscriptionController@preview')->name('sub.show');
    $app->post('subscriptions', 'SubscriptionController@store')->name('sub.save');
});

