# Stock Laravel-Users | A Laravel Users CRUD Management

### About
Laravel users is based off [aaronrichards/laravel-roles](https://github.com/jeremykenedy/laravel-users). Workd out the box with or without the following roles packages:
* [jeremykenedy/laravel-roles](https://github.com/jeremykenedy/laravel-roles)
* [spatie/laravel-permission](https://github.com/spatie/laravel-permission)
* [Zizaco/entrust](https://github.com/Zizaco/entrust)
* [romanbican/roles](https://github.com/romanbican/roles)
* [ultraware/roles](https://github.com/ultraware/roles)

### Installation Instructions
1. From your projects root folder in terminal run:

    Laravel 5.6, 5.7, and 5.8+ use:

    ```
        composer require aaronrichards/laravel-users
    ```


2. Publish the package config and language files by running the following from your projects root folder:

    ```
        php artisan vendor:publish --tag=laravelusers
    ```

### Routes
* ```/users```
* ```/users/{id}```
* ```/users/create```
* ```/users/{id}/edit```

###### Routes In-depth
| Method    | URI                    | Name             | Action                                                                            | Middleware  |
| :-------- | :--------------------- | :--------------- | :-------------------------------------------------------------------------------- | :---------- |
| GET/HEAD  | users                  | users            | aaronrichards\laravelusers\app\Http\Controllers\UsersManagementController@index    | web,auth    |
| POST      | users                  | users.store      | aaronrichards\laravelusers\app\Http\Controllers\UsersManagementController@store    | web,auth    |
| GET/HEAD  | users/create           | users.create     | aaronrichards\laravelusers\app\Http\Controllers\UsersManagementController@create   | web,auth    |
| GET/HEAD  | users/{user}           | users.show       | aaronrichards\laravelusers\app\Http\Controllers\UsersManagementController@show     | web,auth    |
| DELETE    | users/{user}           | user.destroy     | aaronrichards\laravelusers\app\Http\Controllers\UsersManagementController@destroy  | web,auth    |
| PUT/PATCH | users/{user}           | users.update     | aaronrichards\laravelusers\app\Http\Controllers\UsersManagementController@update   | web,auth    |
| GET/HEAD  | users/{user}/edit      | users.edit       | aaronrichards\laravelusers\app\Http\Controllers\UsersManagementController@edit     | web,auth    |


### License
Laravel-Users | A Laravel Users Management Package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT). Enjoy!
