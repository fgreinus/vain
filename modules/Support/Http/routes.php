<?php

Route::group(['prefix' => 'support'], function () {
    Route::get('/', [
        'uses' => 'SupportController@index',
        'as'   => 'support.category.index',
    ]);
});
