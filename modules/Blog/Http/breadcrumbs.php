<?php

use Modules\Blog\Entities\Post;

/*
 * Public Area
 */

Breadcrumbs::register('blog.post.index', function ($breadcrumbs) {
    $breadcrumbs->parent('index.home');
    $breadcrumbs->push(trans('blog::blog.title.index'), route('blog.post.index'));
});

Breadcrumbs::register('blog.post.show', function ($breadcrumbs, $slug) {
    $post = Post::where('slug', $slug)->first();
    $breadcrumbs->parent('blog.post.index');
    $breadcrumbs->push($post->content->title, route('blog.post.show', $slug));
});

/*
 * Admin-Area
 */

Breadcrumbs::register('blog.admin.posts.index', function ($breadcrumbs) {
    $breadcrumbs->parent('blog.post.index');
    $breadcrumbs->push(trans('blog::admin.title.posts'), route('blog.admin.posts.index'));
});

Breadcrumbs::register('blog.admin.posts.edit', function ($breadcrumbs, $id) {
    $post = Post::find($id);
    $breadcrumbs->parent('blog.admin.posts.index');
    $breadcrumbs->push($post->content->title, route('blog.admin.posts.edit', $id));
});

Breadcrumbs::register('blog.admin.posts.create', function ($breadcrumbs) {
    $breadcrumbs->parent('blog.admin.posts.index');
    $breadcrumbs->push(trans('blog::admin.posts.title.create'), route('blog.admin.posts.create'));
});

Breadcrumbs::register('blog.admin.categories.index', function ($breadcrumbs) {
    $breadcrumbs->parent('blog.post.index');
    $breadcrumbs->push(trans('blog::admin.title.categories'), route('blog.admin.categories.index'));
});

Breadcrumbs::register('blog.admin.category.edit', function ($breadcrumbs, $id) {
    $category = Category::find($id);
    $breadcrumbs->parent('blog.admin.category.index');
    $breadcrumbs->push($category->content->name, route('blog.admin.categories.edit', $id));
});

Breadcrumbs::register('blog.admin.categories.create', function ($breadcrumbs) {
    $breadcrumbs->parent('blog.admin.categories.index');
    $breadcrumbs->push(trans('blog::admin.categories.title.create'), route('blog.admin.categories.create'));
});
