<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\FilmController;

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
Route::post('/login','App\Http\Controllers\AuthController@login');
Route::post('/register','App\Http\Controllers\AuthController@Register');
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/employes',[EmployeController::class, 'index']);
Route::get('category/{description}/films', [FilmController::class, 'index'])->name('films.category');
Route::get('/film/{description}',[FilmController::class, 'search']);
Route::post('/film',[FilmController::class, 'store']);
Route::get('/count',[FilmController::class, 'count']);
Route::get('/count1',[FilmController::class, 'count1']);
Route::get('/count2',[FilmController::class, 'count2']);
Route::get('/getDate',[FilmController::class, 'getDate']);

