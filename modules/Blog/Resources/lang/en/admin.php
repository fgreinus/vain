<?php

return [
    'title' => [
        'index'      => 'Blog',
        'posts'      => 'Posts',
        'categories' => 'Categories',
    ],
    'posts' => [
        'field' => [
            'id'           => '#',
            'slug'         => 'Slug',
            'author'       => 'Author',
            'created_at'   => 'Created',
            'published_at' => 'Published',
            'concealed_at' => 'Hide',
            'category_id'  => 'Category',
            'keywords'     => 'Keywords',
            'description'  => 'Description',
            'title'        => 'Title',
            'text'         => 'Text',
        ],
        'action' => [
            'confirm' => 'Confirm',
            'abort'   => 'Cancel',
            'destroy' => 'Delete',
            'edit'    => 'Edit',
            'save'    => 'Save',
            'create'  => 'Create',
        ],
        'delete' => [
            'message' => 'Do you really want to delete this post?',
            'success' => 'The post has successfully been deleted.',
            'error'   => 'An error occurred while trying to delete the post.',
        ],
        'save' => [
            'error'   => 'An error occurred while trying to save the post.',
            'success' => 'The post has successfully been saved.',
        ],
        'section' => [
            'general' => 'General information',
            'dates'   => 'Timing information',
        ],
        'title' => [
            'create' => 'Create a new post',
            'edit'   => 'Edit an existing post',
        ],
    ],
    'categories' => [
        'title' => [
            'index'  => 'Categories',
            'edit'   => 'Edit an existing category',
            'create' => 'Create a new category',
        ],
        'field' => [
            'id'         => '#',
            'slug'       => 'Slug',
            'created_at' => 'Created',
            'post_count' => 'Posts in this Category',
            'name'       => 'Name',
        ],
        'action' => [
            'create'  => 'Create',
            'edit'    => 'Edit',
            'destroy' => 'Delete',
            'confirm' => 'Confirm',
            'abort'   => 'Cancel',
            'save'    => 'Save',
        ],
        'delete' => [
            'message' => 'Do you really want to delete this category?',
            'success' => 'The category has successfully been deleted.',
            'error'   => 'Error when trying to delete the category.',
        ],
        'save' => [
            'success' => 'The category has successfully been saved.',
            'error'   => 'Error when trying to save the category.',
        ],
        'section' => [
            'general' => 'General information',
        ],
    ],
];
