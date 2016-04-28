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

use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    return redirect('cat');
});

Route::resource('cat', 'CatController');

/*
Route::get('cats/create', function () {
    return view('cats.create');
});

Route::get('cats/{cat}', function (Furbook\Cat $cat) {
    return view('cats.show')->with('cat', $cat);
})->where('id', '[0-9]+');

Route::get('cats', function () {
    $cats = Furbook\Cat::all();
    return view('cats.index')->with('cats', $cats);
});

Route::post('cats', function () {
    $cat = Furbook\Cat::create(Input::all());
    return redirect('cats/' . $cat->id)
        ->withSuccess('Cat has been created.');
});

Route::get('cats/{cat}/edit', function (Furbook\Cat $cat) {
    return view('cats.edit')->with('cat', $cat);
});

Route::put('cats/{cat}', function (Furbook\Cat $cat) {
    $cat->update(Input::all());
    return redirect('cats/' . $cat->id)
        ->withSuccess('Cat has been updated.');
});

Route::delete('cats/{cat}', function($cat){
    $cat->delete();
    return redirect('cats')
        ->withSuccess('Cat has been deleted.');
});
*/

Route::get('cats/breeds/{name}', function ($name) {
    $breed = Furbook\Breed::with('cats')
        ->whereName($name)
        ->first();
    return view('cats.index')
        ->with('breed', $breed)
        ->with('cats', $breed->cats);
});

Route::get('about', function () {
    return view('about')->with('number_of_cats', 9000);
});

//$router->controllers([
//    'auth' => 'Auth\AuthController',
//    'password' => 'Auth\PasswordController'
//]);
//
Route::get('admin/dashboard', [
    'middleware' => ['auth', 'admin'],
    'uses' => 'Admin\DashboardController@index'
]);


Route::auth();

Route::get('/home', 'HomeController@index');
