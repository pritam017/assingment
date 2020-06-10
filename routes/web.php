<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();



Route::group(['as'=>'backend.admin.','prefix' => 'admin', 'namespace'=>'Backend', 'middleware' =>['auth','admin']], function () {
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::group(['prefix' => '/categories'], function () {

    Route::get('/manage', 'CategoryController@index')->name('manageCat');
    Route::get('/create', 'CategoryController@create')->name('createCat');
    Route::post('/store', 'CategoryController@store')->name('storeCat');
//Update
    Route::get('/edit/{id}' , 'CategoryController@edit')->name('editCat');
    Route::post('/edit/{id}' , 'CategoryController@update')->name('updateCat');
    //Delete
    Route::post('/delete/{id}' , 'CategoryController@destroy')->name('deleteCat');
});
Route::group(['prefix' => '/brands'], function () {
    Route::get('/manage', 'BrandController@index')->name('manageBrand');
    Route::get('/create', 'BrandController@create')->name('createBrand');
    Route::post('/store', 'BrandController@store')->name('storeBrand');
    //Update
    Route::get('/edit/{id}' , 'BrandController@edit')->name('editBrand');
    Route::post('/edit/{id}' , 'BrandController@update')->name('updateBrand');
    //Delete
    Route::post('/delete/{id}' , 'BrandController@destroy')->name('deleteBrand');
});
Route::group(['prefix' => '/products'], function () {
    Route::get('/manage', 'ProductController@index')->name('manageProduct');
    Route::get('/create', 'ProductController@create')->name('createProduct');
    Route::post('/store', 'ProductController@store')->name('storeProduct');
    //Update
    Route::get('/edit/{id}' , 'ProductController@edit')->name('editProduct');
    Route::post('/edit/{id}' , 'ProductController@update')->name('updateProduct');
    //Delete
    Route::post('/delete/{id}' , 'ProductController@destroy')->name('deleteProduct');
});

Route::group(['prefix' => '/divisions'], function () {
    Route::get('/manage', 'DivisionController@index')->name('manageDivision');
    Route::get('/create', 'DivisionController@create')->name('createDivision');
    Route::post('/store', 'DivisionController@store')->name('storeDivision');
    //Update
    Route::get('/edit/{id}' , 'DivisionController@edit')->name('editDivision');
    Route::post('/edit/{id}' , 'DivisionController@update')->name('updateDivision');
    //Delete
    Route::post('/delete/{id}' , 'DivisionController@destroy')->name('deleteDivision');
});
Route::group(['prefix' => '/districts'], function () {
    Route::get('/manage', 'DistrictController@index')->name('manageDistrict');
    Route::get('/create', 'DistrictController@create')->name('createDistrict');
    Route::post('/store', 'DistrictController@store')->name('storeDistrict');
    //Update
    Route::get('/edit/{id}' , 'DistrictController@edit')->name('editDistrict');
    Route::post('/edit/{id}' , 'DistrictController@update')->name('updateDistrict');
    //Delete
    Route::post('/delete/{id}' , 'DistrictController@destroy')->name('deleteDistrict');
});
});

Route::group(['as'=>'backend.customer.','prefix' => 'customer', 'namespace'=>'Backend', 'middleware' =>['auth','customer']], function () {
    Route::get('/dashboard', 'Customer\DashboardController@index')->name('dashboard');
});
//Backend Web Routes
//Category Routes

