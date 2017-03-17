<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Support\Facades\Route;


Route::post('competition/sign-up', 'Competition@register');

Route::get('competition/sign-up', function() {
    return view('index');
});

Route::get('competition/export-me', 'Competition@export');

Route::post('file-upload', 'Health@save');

Route::get('show-charts', function() {
    return view('echart');
});

Route::get('get-chart-data', 'HealthCharts@getChartData');

Route::get('get-charts-list', 'HealthCharts@getChartsList');
