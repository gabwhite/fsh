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
    return redirect()->action('ProductController@search');
    //return view('welcome');
});

//=================================
// Vendor Sign Up page (unprotected)
//=================================
// Vendor sign up route
Route::get('welcome', 'PublicController@vendorReg');

//=================================
// Product routes (unprotected)
//=================================
Route::get('/product/search', 'ProductController@search');
Route::post('/product/navsearch', 'ProductController@doSearch');

//=================================
// Contact Us routes
//=================================
Route::get('contact', 'PublicController@contactUs');
Route::post('contact', 'PublicController@contactUsSubmit');
//=================================

//=================================
// Routes that require authentication
//=================================
Route::group(['middleware' => 'auth'], function()
{
    // Product details
    Route::get('/product/detail/{id}', 'ProductController@detail');

    // Vendor details
    Route::get('vendor/detail/{id}', 'VendorController@detail');

    Route::get('/profile', 'ProfileController@index');
    Route::get('/profile/edit', 'ProfileController@profileEdit');
    Route::post('/profile/edit', 'ProfileController@profileUpdate');
    Route::get('/profile/avatar', 'ProfileController@profileAvatar');
    Route::post('/profile/avatar', 'ProfileController@profileAvatarUpdate');
    Route::get('/profile/favorites', 'ProfileController@profileFavoriteProducts');
    Route::post('/profile/favorites', 'ProfileController@deleteFavoriteProducts');


    // Routes that require either admin or vendor roles
    Route::group(['middleware' => ['role:vendor|admin']], function()
    {
        Route::get('/product/vendor', 'ProductController@vendorProducts');
        Route::post('/product/vendor', 'ProductController@vendorProductsAction');
        Route::get('/product/edit/{id?}', 'ProductController@showEditProduct');
        Route::post('/product/edit', 'ProductController@editProduct');
        Route::get('/vendor/edit', 'VendorController@edit');
        Route::post('/vendor/edit', 'VendorController@update');
        Route::post('/vendor/edit/addbrand', 'VendorController@addBrand');
        Route::post('/vendor/edit/deletebrand', 'VendorController@deleteBrand');
        Route::post('/vendor/edit/addasset', 'VendorController@addAsset');
        Route::post('/vendor/edit/variableupdate', 'VendorController@updateVendorVariable');
    });

    //=================================
    // Routes that require admin role
    //=================================
    Route::group(['middleware' => ['role:admin']], function()
    {
        // Admin routes
        Route::get('admin/', 'AdminController@index');
        Route::get('admin/users', 'AdminController@showUsers');
        Route::get('admin/adduser', 'AdminController@showUserAdd');
        Route::post('admin/adduser', 'AdminController@addUser');
        Route::get('admin/addvendor', 'AdminController@showVendorAdd');
        Route::post('admin/addvendor', 'AdminController@addVendor');
        Route::get('admin/userview/{id}', 'AdminController@viewUser');
        Route::post('admin/edituser', 'AdminController@editUser');
        Route::get('admin/import', 'AdminController@showImport');
        Route::post('admin/import', 'AdminController@doImport');
        Route::get('admin/roles', 'AdminController@showRoles');
        Route::post('admin/roles', 'AdminController@editRoles');
        Route::get('admin/permissions/{id?}', 'AdminController@showPermissions');
        Route::post('admin/permissions', 'AdminController@editPermissions');
        Route::get('admin/cache', 'AdminController@showCacheManager');
        Route::post('admin/cache', 'AdminController@editCache');
        Route::get('admin/categories', 'AdminController@showCategories');
        Route::get('admin/category/edit/{id}', 'AdminController@showEditCategory');
        Route::post('admin/category/edit/{id}', 'AdminController@updateCategory');
        Route::get('admin/category/add', 'AdminController@showAddCategory');
        Route::post('admin/category/add', 'AdminController@addCategory');

    });
});

//=================================
// Authentication routes...
//=================================
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['middleware' => 'postlogin', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['middleware' => 'postlogout', 'uses' => 'Auth\AuthController@getLogout']);

//=================================
// Password reset link request routes...
//=================================
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

//=================================
// Password reset routes...
//=================================
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//=================================
// Registration routes...
//=================================
//Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::get('auth/register', 'Auth\AuthController@getUserRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('auth/vendorregister', 'Auth\AuthController@getVendorRegister');
Route::post('auth/vendorregister', ['middleware' => 'postlogin', 'uses' => 'Auth\AuthController@postVendorRegister']);

//=================================
// AJAX routes
//=================================
Route::get('ajax/getfoodcategories/{format}/{parentId?}', 'AjaxController@getFoodCategoriesForParent');
Route::get('ajax/getproducts/{categoryId?}', 'AjaxController@getProducts');
Route::get('ajax/getcountries', 'AjaxController@getCountries');
Route::get('ajax/getstateprovincesforcountry/{countryId}', 'AjaxController@getStateProvincesForCountry');
Route::get('ajax/checkusername', 'AjaxController@checkUsername');
Route::get('ajax/checkemail', 'AjaxController@checkEmail');
Route::post('ajax/addproductfav', 'AjaxController@addFavoriteProduct');
