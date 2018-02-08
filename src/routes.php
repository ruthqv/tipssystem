<?php

//

Route::group(['prefix' => 'api', 'as' => 'api'], function () {

    Route::group(['prefix' => 'tips', 'as' => 'tips'], function () {
     
	Route::resource('tip','tip\tipsystem\TipsController');
	Route::resource('tipCategory','tip\tipsystem\TipsCategoriesController');



    });

});


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth','role:admin']], function () {
        Route::get('/tips', function () {
             return view('layouts.app');
            });
 });
