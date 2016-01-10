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

// Home route
Route::get('/', function ()
{
    return view('welcome');
});

//=================================
// Product routes
//=================================
Route::get('/product/search', 'ProductController@search');
Route::post('/product/search', 'ProductController@fullTextSearch');
Route::get('/product/detail/{id}', 'ProductController@detail');


//=================================
// Contact Us routes
//=================================
Route::get('contact', 'PublicController@contactUs');
Route::post('contact', 'PublicController@contactUsSubmit');
//=================================

Route::get('vendor/detail/{id}', 'VendorController@detail');


Route::get('toolsresources', function() { return view('toolsresources'); } );

Route::get('industryforums', function() { return view('industryforums'); } );


// Routes the require authentication
Route::group(['middleware' => 'auth'], function()
{
    Route::get('/profile', 'ProfileController@index');
    Route::get('/profile/edit', 'ProfileController@profileEdit');
    Route::post('/profile/edit', 'ProfileController@profileUpdate');
    Route::get('/profile/avatar', 'ProfileController@profileAvatar');
    Route::post('/profile/avatar', 'ProfileController@profileAvatarUpdate');


    // Routes that require either admin or vendor roles
    Route::group(['middleware' => ['role:vendor|admin']], function()
    {
        Route::get('/product/vendor', 'ProductController@vendorProducts');
        Route::get('/product/edit/{id?}', 'ProductController@showProduct');
        Route::post('/product/edit', 'ProductController@editProduct');
        Route::get('/vendor/edit', 'VendorController@edit');
        Route::post('/vendor/edit', 'VendorController@update');
    });




    // Admin routes
    Route::get('admin/', 'AdminController@index');
    Route::get('admin/users', 'AdminController@showUsers');
    Route::get('admin/adduser', 'AdminController@showUserAdd');
    Route::post('admin/adduser', 'AdminController@addUser');
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

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('auth/vendorregister', 'Auth\AuthController@getVendorRegister');
Route::post('auth/vendorregister', 'Auth\AuthController@postVendorRegister');

// AJAX routes
Route::get('ajax/getfoodcategories/{format}/{parentId?}', 'AjaxController@getFoodCategoriesForParent');
Route::get('ajax/getproducts/{categoryId}', 'AjaxController@getProducts');
Route::get('ajax/getcountries', 'AjaxController@getCountries');
Route::get('ajax/getstateprovincesforcountry/{countryId}', 'AjaxController@getStateProvincesForCountry');
Route::get('ajax/productsearch/{query}', 'AjaxController@getProductFullTextSearch');
