<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Route;
=======
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
>>>>>>> 78134d595fe4aa8c57c6b996d9f2cdf52e2bd44d

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

<<<<<<< HEAD
//  Route::get('/', function () {
//       return view('welcome');
//  });
 Route::get('/','IndexController@index');


    


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']],function(){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::resource('product', 'ProductController');
    Route::resource('category', 'CategoryController');

});



=======
Route::get('/','HomeController@index')->name('home');
Route::get('profile/{username}','AuthorController@profile')->name('author.profile');

Auth::routes();

Route::group(['middleware'=>['auth']], function () {
	// favourite/{post}/add = without add it also works , its nothing for remember
	Route::post('favourite/{product}/add','FavoriteController@add')->name('product.favorite');
	
});

Route::group( ['as'=>'admin.','prefix' => 'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function () {
    Route::get('dashboard','DashboardController@index')->name('dashboard');
     Route::resource('tag','TagController');
     Route::resource('category','CategoryController');
     Route::resource('product','ProductController');
     Route::get('settings','SettingsController@index')->name('settings');
     Route::put('profile','SettingsController@update')->name('profile.update');
     Route::put('password','SettingsController@password_update')->name('password.update');

     Route::get('pending/product','ProductController@pending')->name('product.pending');
     Route::Put('product/{id}/approve','ProductController@approval')->name('product.approve');
});

Route::group( ['as'=>'author.','prefix' => 'author','namespace'=>'Author','middleware'=>['auth','author']], function () {
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::resource('product','ProductController');
    Route::get('settings','SettingsController@index')->name('settings');
    Route::put('profile','SettingsController@update')->name('profile.update');
    Route::put('password','SettingsController@password_update')->name('password.update');
});
>>>>>>> 78134d595fe4aa8c57c6b996d9f2cdf52e2bd44d
