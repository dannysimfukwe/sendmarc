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

//moved other routes to routes/api.php

Route::get('/', function() {
    return redirect('/tasks');
});

Route::get('/tasks', function () {
    return view('welcome');
});

