<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', function()
{
    return view('search');
});

Route::get('productdetail/{id}', 'PublicController@productDetail');

Route::post('fulltextsearch', 'PublicController@fullTextSearch');

Route::get('toolsresources', function() { return view('toolsresources'); } );
Route::get('industryforums', function() { return view('industryforums'); } );

// Routes the require authentication
Route::group(['middleware' => 'auth'], function()
{

    // Public routes
    Route::get('/profile', 'ProfileController@index');
    Route::get('/profile/product/{id?}', 'ProfileController@showProduct');
    Route::post('/profile/product', 'ProfileController@editProduct');

    // Admin routes
    Route::get('admin/', 'AdminController@index');
    Route::get('admin/users', 'AdminController@showUsers');
    Route::get('admin/userview/{id}', 'AdminController@viewUser');
    Route::post('admin/edituser', 'AdminController@editUser');
    Route::get('admin/import', 'AdminController@showImport');
    Route::post('admin/import', 'AdminController@doImport');
    Route::get('admin/roles', 'AdminController@showRoles');
    Route::post('admin/roles', 'AdminController@editRoles');
    Route::get('admin/permissions/{id?}', 'AdminController@showPermissions');
    Route::post('admin/permissions', 'AdminController@editPermissions');
    Route::get('admin/searchindexes', 'AdminController@showSearchIndexes');
    Route::post('admin/createsearchindex', 'AdminController@createSearchIndex');
    Route::post('admin/managesearchindex', 'AdminController@manageSearchIndex');
});



// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['middleware' => 'redirectonrole', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// AJAX routes
Route::get('ajax/getfoodcategories/{format}/{parentId?}', 'AjaxController@getFoodCategoriesForParent');
Route::get('ajax/getuserproducts/{categoryId}', 'AjaxController@getUserProducts');