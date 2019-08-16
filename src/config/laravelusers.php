<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel-users setting
    |--------------------------------------------------------------------------
    */

    // Blade templates
    'bladeLayout'                   => 'laravelusers::layouts.app',
    'showUsersBlade'                => 'laravelusers::usersmanagement.show-users',
    'createUserBlade'               => 'laravelusers::usersmanagement.create-user',
    'showUserBlade'                 => 'laravelusers::usersmanagement.show-user',
    'editUserBlade'                 => 'laravelusers::usersmanagement.edit-user',

    // Enable `auth` middleware
    'authEnabled'                   => true,

    // Default User Model
    'defaultUserModel'              => 'App\User',

    /*
     | Enable Roles Middlware on the usability of this package.
     | This requires the middleware from the roles package to be registered in `App\Http\Kernel.php`
     | An Example: of roles middleware entry in protected `$routeMiddleware` array would be:
     | 'role' => \jeremykenedy\LaravelRoles\Middleware\VerifyRole::class,
     */

    'rolesEnabled'                  => false,

    'rolesMiddlwareEnabled'         => true,

    // Optional Roles Middleware
    'rolesMiddlware'                => 'role:admin',

    // Optional Role Model
    'roleModel'                     => 'jeremykenedy\LaravelRoles\Models\Role',

];
