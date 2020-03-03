<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/tasks', 'TaskFighter@tasks');

Route::post('/tasks', 'TaskFighter@create');

Route::get('/list/tick', 'TaskFighter@tick');

Route::delete('/tasks/{id}', 'TaskFighter@delete');