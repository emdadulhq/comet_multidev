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

Route::get('/', 'App\Http\Controllers\FrontendController@homePage')->name('welcome');
Route::get('/blog', 'App\Http\Controllers\FrontendController@blogPage')-> name('blog');
Route::get('/blog-single/{slug}', 'App\Http\Controllers\FrontendController@blogsinglePage')->name('blog.single');


//Blog Post Search by Category
Route::get('category/{slug}', 'App\Http\Controllers\FrontendController@postByCategory')->name('blog.search.category');

//Blog Post Search by Tag
Route::get('tag/{slug}', 'App\Http\Controllers\FrontendController@postByTag')->name('blog.search.tag');
//Blog Post Search by Search Field
Route::post('search', 'App\Http\Controllers\FrontendController@postBySearch')->name('blog.search');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Category Routes
Route::resource('posts-category', 'App\Http\Controllers\CategoryController');
Route::get('posts-category-edit/{id}', 'App\Http\Controllers\CategoryController@edit');
Route::post('posts-category-update', 'App\Http\Controllers\CategoryController@update') -> name('category.update');
Route::get('posts-category-unpublished/{id}', 'App\Http\Controllers\CategoryController@UnpublishedStatus')->name('category.unpublished');
Route::get('posts-category-published/{id}', 'App\Http\Controllers\CategoryController@PublishedStatus')->name('category.published');


// Tag Routes
Route::resource('tag', 'App\Http\Controllers\TagController');
Route::get('posts-tag-edit/{id}', 'App\Http\Controllers\TagController@edit');
Route::post('posts-tag-update', 'App\Http\Controllers\TagController@update') -> name('tag.update');
Route::get('posts-tag-unpublished/{id}', 'App\Http\Controllers\TagController@UnpublishedStatus')->name('tag.unpublished');
Route::get('posts-tag-published/{id}', 'App\Http\Controllers\TagController@PublishedStatus')->name('tag.published');

//Post Reoutes
Route::resource('post', 'App\Http\Controllers\PostController');
Route::get('post-edit/{id}', 'App\Http\Controllers\PostController@edit');
Route::post('post-update', 'App\Http\Controllers\PostController@update') -> name('post.update');
Route::get('post-unpublished/{id}', 'App\Http\Controllers\PostController@UnpublishedStatus')->name('post.unpublished');
Route::get('post-published/{id}', 'App\Http\Controllers\PostController@PublishedStatus')->name('post.published');


//Settings Route
Route::get('settings/logo', 'App\Http\Controllers\SettingsController@LogoIndex')->name('logo.index');
Route::put('settings/logo-update', 'App\Http\Controllers\SettingsController@LogoUpdate')->name('logo.update');

//Settings Route (Social)
Route::get('settings/social', 'App\Http\Controllers\SettingsController@socialIndex')->name('social.index');
Route::post('settings/social-update', 'App\Http\Controllers\SettingsController@socialUpdate')->name('social.update');


Route::group(['namespace'=>'App\Http\Controllers', 'prefix'=>'home'], function(){
    Route::get('slider', 'HomepageController@index')->name('slider.index');
    Route::post('slider/store', 'HomepageController@sliderStore')->name('slider.store');
});































