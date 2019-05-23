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

Auth::routes();
Route::match(['get', 'post'], 'register', function () {
    Auth::logout();
    return redirect('/');
})->name('register');

Route::prefix(App\Http\Middleware\Locale::getLocale())->group(function () {

    Route::resource('/', 'indexController')->only(['index'])->names('home');
    Route::resource('prices', 'priceController')->only(['show'])->names('prices');
    Route::get('blog', 'blogController@index')->name('blogMain');
    Route::get('/blog/cat-{cat}', 'blogController@cat')->name('blogCat');
    Route::get('blog/cat-{cat}/post-{post}', 'blogController@post')->name('blogPost');

    Route::get('unsubscribe/{hash}', 'subscribeController@show')->name('unsubscribe');

    Route::middleware('throttle:5,60')->group(function () {
        Route::resource('/comment', 'commentController')->only(['store'])->names('comment');
        Route::resource('/subscribe', 'subscribeController')->only(['store', 'destroy'])->names('subscribe');
        Route::resource('/message', 'messageController')->only(['store'])->names('message');
    });
});

Route::middleware(['auth'])->prefix('backend')->namespace('Backend')->name('backend.')->group(function () {

    Route::get('/', 'IndexController@index')->name('index');

    Route::resource('/menus', 'MenuController')->names('menus');
    Route::resource('/portfolios', 'PortfolioController')->names('portfolios');
    Route::resource('/prices', 'PriceController')->names('prices');
    Route::resource('/sliders', 'SliderController')->names('sliders');
    Route::resource('/filters', 'FilterController')->names('filters');
    Route::resource('/permissions', 'PermissionController')->only(['index', 'store'])->names('permissions');
    Route::resource('/messages', 'MessageController')->only(['index', 'show', 'destroy'])->names('messages');
    Route::resource('/comments', 'CommentController')->except('create', 'store', 'show')->names('comments');
    Route::resource('/blog', 'BlogController')->names('blog');
});