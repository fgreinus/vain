<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authorization Role Model
    |--------------------------------------------------------------------------
    |
    | This is the Role model used to create correct relations.  Update
    | the role if it is in a different namespace.
    |
    */

    'role' => 'Modules\User\Entities\Role',

    /*
    |--------------------------------------------------------------------------
    | Authorization Roles Table
    |--------------------------------------------------------------------------
    |
    | This is the roles table used to save roles to the database.
    |
    */

    'roles_table' => 'roles',

    /*
    |--------------------------------------------------------------------------
    | Authorization Permission Model
    |--------------------------------------------------------------------------
    |
    | This is the Permission model used to create correct relations.
    | Update the permission if it is in a different namespace.
    |
    */

    'permission' => 'Modules\User\Entities\Permission',

    /*
    |--------------------------------------------------------------------------
    | Authorization Permissions Table
    |--------------------------------------------------------------------------
    |
    | This is the permissions table used to save permissions to the
    | database.
    |
    */

    'permissions_table' => 'permissions',

    /*
    |--------------------------------------------------------------------------
    | Authorization permission_role Table
    |--------------------------------------------------------------------------
    |
    | This is the permission_role table used to save relationship
    | between permissions and roles to the database.
    |
    */

    'permission_role_table' => 'permission_role',

    /*
    |--------------------------------------------------------------------------
    | Authorization role_user Table
    |--------------------------------------------------------------------------
    |
    | This is the role_user table used to save assigned roles to the
    | database.
    |
    */

    'role_user_table' => 'role_user',

];
