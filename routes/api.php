<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\ClientApiController;
use App\Http\Controllers\Api\TaskApiController;
use App\Http\Controllers\Api\ProjectApiController;
use App\Http\Controllers\Api\TagApiController;

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

Route::get('clients', [ClientApiController::class, 'index'])->name('clients.data');
Route::get('users', [UserApiController::class, 'index'])->name('users.data');
Route::get('projects', [ProjectApiController::class, 'index'])->name('projects.data');
Route::get('tasks', [TaskApiController::class, 'index'])->name('tasks.data');
Route::get('tags', [TagApiController::class, 'index'])->name('tags.data');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
   
});
