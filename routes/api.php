<?php

use App\Http\Controllers\API\FolderController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\NoteController;
use App\Http\Controllers\API\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth
Route::post('login', LoginController::class)->middleware('guest:api');
Route::post('register', RegisterController::class)->middleware('guest:api');

// Folder
Route::resource('folders', FolderController::class)->except(['create', 'edit', 'show', 'update', 'destroy']);

// Note
Route::resource('notes', NoteController::class)->except(['create', 'edit', 'show', 'update', 'destroy']);

