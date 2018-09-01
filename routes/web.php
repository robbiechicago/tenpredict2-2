<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index');
Route::get('/admin/calc_weekly_scores/{week_id}', 'AdminController@calc_weekly_scores');
Route::get('/admin/missing_abbrv/{week_id}', 'AdminController@missing_abbrv');
Route::post('/admin/add_abbrv', 'AdminController@add_abbrv');
Route::post('/admin', 'AdminController@create_weeks');

Route::get('season/{season}/week/{play_week_num}/predictions', 'PredictionController@predictions_by_season_week');
Route::get('prediction/tot_points_week/{game}', 'PredictionController@tot_points_week');
Route::post('prediction/submit', 'PredictionController@submit');

Route::get('game/{game}', 'GameController@show');

Route::resource('forum', 'ForumController');
Route::resource('league', 'LeagueController');


//pages
Route::get('weekly-scores/{week}', 'WeeklyscoresController@show');

Route::get('/how', function () {
    return view('pages.how');
});

Route::get('/payment', function () {
    return view('pages.payment');
});
