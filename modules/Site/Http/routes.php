<?php

/**
 * Frontend.
 */
Route::group(['prefix' => 'sites'], function () {
    Route::get('{slug}', ['as' => 'site.show', 'uses' => 'SiteController@getPage']);
});

/*
 * Backend
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('sites', 'SiteController', ['names' => [
        'index'   => 'site.admin.sites.index',
        'create'  => 'site.admin.sites.create',
        'store'   => 'site.admin.sites.store',
        'show'    => 'site.admin.sites.show',
        'edit'    => 'site.admin.sites.edit',
        'update'  => 'site.admin.sites.update',
        'destroy' => 'site.admin.sites.destroy',
    ]]);
});
