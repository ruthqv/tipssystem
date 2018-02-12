<?php

//

Route::group(['prefix' => 'api', 'as' => 'api'], function () {
    Route::group(['prefix' => 'tips', 'as' => 'tips'], function () {
    
    Route::resource('tip','tip\tipsystem\TipsController');


	Route::post('searchcategory/{category?}','tip\tipsystem\TipsController@search');

    });

});


