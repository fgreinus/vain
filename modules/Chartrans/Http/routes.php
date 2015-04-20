<?php

Route::group(['prefix' => 'chartrans', 'namespace' => 'Modules\Chartrans\Http\Controllers'], function()
{
    Route::get('/', [
        'uses' => 'ChartransController@index',
        'as' => 'chartrans.chartrans.index'
    ]);

    Route::get('status', [
        'uses' => 'ChartransController@status',
        'as' => 'chartrans.chartrans.status'
    ]);

    Route::group(['prefix' => 'step'], function() {

        Route::get('/destination', [
            'uses' => 'StepController@showStepOne',
            'as' => 'chartrans.step.one.show'
        ]);

        Route::get('/source', [
            'uses' => 'StepController@showStepTwo',
            'as' => 'chartrans.step.two.show'
        ]);

        Route::get('/upload', [
            'uses' => 'StepController@showStepThree',
            'as' => 'chartrans.step.three.show'
        ]);

        Route::get('/character', [
            'uses' => 'StepController@showStepFour',
            'as' => 'chartrans.step.four.show'
        ]);

        Route::get('/overview', [
            'uses' => 'StepController@showStepFive',
            'as' => 'chartrans.step.five.show'
        ]);

        Route::post('/destination', [
            'uses' => 'StepController@storeStepOne',
            'as' => 'chartrans.step.one.store'
        ]);

        Route::post('/source', [
            'uses' => 'StepController@storeStepTwo',
            'as' => 'chartrans.step.two.store'
        ]);

        Route::post('/upload', [
            'uses' => 'StepController@storeStepThree',
            'as' => 'chartrans.step.three.store'
        ]);

        Route::post('/character', [
            'uses' => 'StepController@storeStepFour',
            'as' => 'chartrans.step.four.store'
        ]);

        Route::post('/overview', [
            'uses' => 'StepController@storeStepFive',
            'as' => 'chartrans.step.five.store'
        ]);
    });
});