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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\ProjectController;
use App\Http\Controllers\Web\TaskController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\TagController;

Route::get('/', function() {
	return redirect('/dashboard');
});

	
	
Route::group(['middleware' => 'guest'], function() {
	Route::get('/register', [RegisterController::class, 'create'])->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->name('login');
	Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->name('change.perform');

	//Confirm email
	Route::get('/registration/success', function() {
		$referer = request()->headers->get('referer');
		if($referer == route('register')) {
			return view('pages.registration_success');
		} else return redirect()->back();
	});
	Route::get('/confirm/email', [RegisterController::class, 'confirm_email'])->name('confirm.email');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');

	//Users

    // Route::get('users/data', [UserController::class, 'data'])->name('users_data');
	Route::resource('users', UserController::class);
	// Route::get('')

	//Clients
	Route::resource('clients', ClientController::class);

	//Projects
	Route::resource('projects', ProjectController::class);

	//Tasks
	Route::resource('tasks', TaskController::class);

	//Tags
	Route::resource('tags', TagController::class);
});

