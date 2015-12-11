<?php

return [
    'title' => [
        'index'  => 'Blog',
        'teaser' => 'Its about time that you get up to date!',
        'post'   => 'Blog: :name',
    ],
    'index' => 'Blog',
    'post'  => [
        'more' => 'Read more...',
    ],
    'comment' => [
        'save' => [
            'error'   => 'An error occurred while trying to store your comment',
            'success' => 'Comment successfully created',
            'button'  => 'Comment',
        ],
        'delete' => [
            'error'   => 'Error when trying to delete the comment',
            'success' => 'Comment successfully deleted',
            'button'  => 'Delete',
        ],
        'write'       => 'Write new comment',
        'placeholder' => 'Now it\'s time for your comment...',
        'count'       => ':count Comment|:count Comments',
        'credits'     => 'posted at :time by',
    ],
];
