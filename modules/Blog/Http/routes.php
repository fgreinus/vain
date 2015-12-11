<?php

Route::group(['prefix' => 'blog'], function () {
    Route::get('/', [
        'uses' => 'PostController@index',
        'as'   => 'blog.post.index',
    ]);

    Route::get('{slug}', [
        'uses' => 'PostController@show',
        'as'   => 'blog.post.show',
    ]);

    Route::group(['prefix' => 'category'], function () {

        Route::get('{slug}', [
            'uses' => 'CategoryController@show',
            'as'   => 'blog.category.show',
        ]);
    });

    Route::group(['prefix' => 'comment'], function () {

        Route::post('{postId}', [
            'uses' => 'CommentController@store',
            'as'   => 'blog.comment.store',
        ]);

        Route::delete('{id}', [
            'uses' => 'CommentController@destroy',
            'as'   => 'blog.comment.destroy',
        ]);
    });
});

/*
 * Backend
 */
Route::group(['prefix' => 'admin/blog', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('posts', 'PostController', ['names' => [
        'index'   => 'blog.admin.posts.index',
        'create'  => 'blog.admin.posts.create',
        'store'   => 'blog.admin.posts.store',
        'show'    => 'blog.admin.posts.show',
        'edit'    => 'blog.admin.posts.edit',
        'update'  => 'blog.admin.posts.update',
        'destroy' => 'blog.admin.posts.destroy',
    ]]);

    Route::resource('categories', 'CategoryController', ['names' => [
        'index'   => 'blog.admin.categories.index',
        'create'  => 'blog.admin.categories.create',
        'store'   => 'blog.admin.categories.store',
        'show'    => 'blog.admin.categories.show',
        'edit'    => 'blog.admin.categories.edit',
        'update'  => 'blog.admin.categories.update',
        'destroy' => 'blog.admin.categories.destroy',
    ]]);
});
