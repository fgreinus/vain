<?php

return [
    'title' => [
        'index'  => 'Permissions',
        'edit'   => 'Create permission',
        'create' => 'Edit permission',
    ],
    'action' => [
        'save'    => 'Save',
        'abort'   => 'Abort',
        'confirm' => 'Confirm',
    ],
    'field' => [
        'id'          => '#',
        'alias'       => 'Alias',
        'name'        => 'Name',
        'description' => 'Description',
        'created_at'  => 'Created',
        'updated_at'  => 'Updated',
    ],
    'delete' => [
        'message' => 'Do you really want to delete the selected permission?',
        'success' => 'Permission has been deleted!',
        'error'   => 'Permission was not deleted!',
    ],
    'save' => [
        'success' => 'Permission has been saved!',
        'error'   => 'Permission has not been saved!',
    ],
    'lock' => 'The Permission can not be modified!',
];
