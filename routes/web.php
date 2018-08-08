<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index');
Route::post('/admin', 'AdminController@create_weeks');

Route::get('season/{season}/week/{play_week_num}/predictions', 'PredictionController@predictions_by_season_week');
Route::get('prediction/tot_points_week/{game}', 'PredictionController@tot_points_week');
Route::post('prediction/submit', 'PredictionController@submit');

Route::get('game/{game}', 'GameController@show');


//pages
Route::get('/how', function () {
    return view('pages.how');
});