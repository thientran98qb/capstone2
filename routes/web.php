<?php

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

use Illuminate\Routing\Console\MiddlewareMakeCommand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Route::get('/', 'HomeController@index');
Route::group(['middleware' => 'locale'], function() {
    Route::group(['prefix' => 'admin','namespace'=>'Admin','as'=>'admin.'], function () {
            Route::get('login','AdminLoginController@loginAdmin')->name('login');
            Route::post('login','AdminLoginController@processLogin')->name('process.login');
            Route::get('logout','AdminLoginController@getLogout')->name('getLogout');
        Route::middleware(['admin-login'])->group(function () {
            Route::get('/', function () {
                return view('admin/home');
            })->name('home.admin');
            Route::prefix('category')->group(function(){
                Route::get('','CategoryController@index')->name('category.index')->middleware('can:category-list');
                Route::get('/add','CategoryController@create')->name('category.create');
                Route::post('/add','CategoryController@store')->name('category.store');
                Route::get('/edit/{id}','CategoryController@edit')->name('category.edit');
                Route::post('/update/{id}','CategoryController@update')->name('category.update');
                Route::post('/destroy/{id}','CategoryController@destroy')->name('category.destroy');
            });
            Route::prefix('menu')->group(function(){
                Route::get('','MenuController@index')->name('menu.index');
                Route::get('/add','MenuController@create')->name('menu.create');
                Route::post('/add','MenuController@store')->name('menu.store');
                Route::get('/edit/{id}','MenuController@edit')->name('menu.edit');
                Route::post('/update/{id}','MenuController@update')->name('menu.update');
                Route::post('/destroy/{id}','MenuController@destroy')->name('menu.destroy');
            });
            Route::prefix('product')->group(function(){
                Route::get('','ProductController@index')->name('product.index');
                Route::get('/search','ProductController@search')->name('product.search');
                Route::get('/add','ProductController@create')->name('product.create');
                Route::post('/add','ProductController@store')->name('product.store');
                Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
                Route::post('/update/{id}','ProductController@update')->name('product.update');
                Route::get('/product/delete/{id}', 'ProductController@delete')->name('delete_product');
                Route::post('/UploadNewsPhoto','ProductController@UploadNewsPhoto');
            });
            Route::prefix('slide')->group(function(){
                Route::get('','SliderController@index')->name('slide.index');
                Route::get('/add','SliderController@create')->name('slide.create');
                Route::post('/add','SliderController@store')->name('slide.store');
                Route::get('/edit/{id}','SliderController@edit')->name('slide.edit');
                Route::post('/update/{id}','SliderController@update')->name('slide.update');
                Route::get('/slide/delete/{id}', 'SliderController@delete')->name('delete_slide');
            });
            Route::prefix('setting')->group(function(){
                Route::get('','SettingController@index')->name('setting.index');
                Route::get('/add','SettingController@create')->name('setting.create');
                Route::post('/add','SettingController@store')->name('setting.store');
                Route::get('/edit/{id}','SettingController@edit')->name('setting.edit');
                Route::post('/update/{id}','SettingController@update')->name('setting.update');
                Route::get('/setting/delete/{id}', 'SettingController@delete')->name('delete_setting');
            });
            Route::prefix('user')->group(function(){
                Route::get('','UserController@index')->name('user.index');
                Route::get('/add','UserController@create')->name('user.create');
                Route::post('/add','UserController@store')->name('user.store');
                Route::get('/edit/{id}','UserController@edit')->name('user.edit');
                Route::post('/update/{id}','UserController@update')->name('user.update');
                Route::post('/destroy/{id}','UserController@destroy')->name('user.destroy');
                Route::get('deleteforce','UserController@action')->name('user.delete.force');
            });
            Route::prefix('role')->group(function(){
                Route::get('','RoleController@index')->name('role.index');
                Route::get('/add','RoleController@create')->name('role.create');
                Route::post('/add','RoleController@store')->name('role.store');
                Route::get('/edit/{id}','RoleController@edit')->name('role.edit');
                Route::post('/update/{id}','RoleController@update')->name('role.update');
                Route::post('/destroy/{id}','RoleController@destroy')->name('role.destroy');
            });
            Route::prefix('permission')->group(function(){
                Route::get('/add','PermissionController@create')->name('per.create');
                Route::post('/add','PermissionController@store')->name('per.store');
                Route::get('/edit/{id}','PermissionController@edit')->name('per.edit');
            });
            Route::prefix('table')->group(function(){
                Route::get('','TableController@index')->name('table.index');
                Route::get('/add','TableController@create')->name('table.create');
                Route::post('/add','TableController@store')->name('table.store');
                Route::get('/edit/{id}','TableController@edit')->name('table.edit');
                Route::post('/update/{id}','TableController@update')->name('table.update');
                Route::get('/delete/{id}','TableController@delete')->name('table.destroy');
            });
            Route::prefix('orders')->group(function(){
                Route::get('','OrderController@index')->name('order.index');
                Route::get('/add','OrderController@create')->name('order.create');
                Route::post('/add','OrderController@store')->name('order.store');
                Route::get('/edit/{id}','OrderController@edit')->name('order.edit');
                Route::post('/update/{id}','OrderController@update')->name('order.update');
                Route::get('/delete/{id}','OrderController@delete')->name('order.destroy');

                Route::post('/update_status/{id}','OrderController@updateStatus')->name('update.status');
                Route::get('/manage_reser','OrderController@reservationTable')->name('reservation.index');
                Route::get('/changeStatus','OrderController@changeStatus')->name('change.status');
            });
        });

    });
    Route::group(['prefix' => 'customer','namespace'=>'Customer','as'=>'customer.'], function () {
        Route::resource('menu', 'MenuController');
        Route::get('addcart/{id}','CartController@addCart')->name('add.cart');
        Route::get('changeitem/{id}','CartController@changeItem')->name('change.item.cart');
        Route::get('removeitem/{id}','CartController@removeItem')->name('remove.item.cart');
        Route::get('/product/{id}','ProductController@index')->name('product.index');
        Route::middleware(['auth'])->group(function () {
            Route::post('/product/comment','ProductController@getComment')->name('product.commet');
            Route::post('comment/update', 'ProductController@update')->name('comment.update');
    Route::delete('comment/destroy', 'ProductController@destroy')->name('comment.destroy');
            Route::get('/checkout','CheckoutController@index')->name('checkout');
            Route::post('/order','CheckoutController@orders')->name('orders');
        });

    });
    Route::get('change-language/{language}', 'HomeController@changeLanguage')
        ->name('user.change-language');
});
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/booktable', 'BookTableController@index')->name('book.table');
    Route::get('/filter.table', 'BookTableController@filterTable')->name('filter.table');
    Route::post('/reservation', 'BookTableController@reservationTable')->name('reservation.table');

});
Route::get('/auth/{provider}', 'SocialController@redirectToProvider');
Route::get('/auth/{provide}/callback', 'SocialController@handleProviderCallback');