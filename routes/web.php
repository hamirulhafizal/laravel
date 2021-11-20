<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SignUpController;

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
    return view('main');
});

Route::get('/member/login', [ MemberController::class, 'login' ] );

Route::get('/member/register', [ MemberController::class, 'register' ] );

Route::get('/member', [ MemberController::class, 'index' ]);

Route::get('/member/profile', [ MemberController::class, 'profile' ]);

Route::get('/dashboard', [ 
	MemberController::class,
	'index'])
	->name('dashbaord')
	->middleware(['auth']);


Route::middleware(['auth', 'can:is-admin'])->group(function(){

	Route::resource('admin/user', UserController::class);
	Route::resource('admin/role', RoleController::class);
	Route::resource('admin/plan', PlanController::class);
	
});

Route::get('/signup', [ SignUpController::class, 'index' ]);
Route::get('/signup/review/{id}', [ SignUpController::class, 'review' ]);
Route::post('/signup/go/{payment_gateway}', [ SignUpController::class, 'go' ])->name('signup.go');


