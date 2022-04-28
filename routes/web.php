<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;



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


Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

Route::get('/', [JobController::class, 'index'])->name('jobs.index');

Route::get('/register', [RegisterController::class, 'index'])->name('registration.index');
Route::post('/register', [RegisterController::class, 'register'])->name('registration.create');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login'); //goes with the auth middleware
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

//companies
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/add', [CompanyController::class, 'add'])->name('companies.add');
Route::get('/companies/{id}', [CompanyController::class, 'profile'])->name('companies.profile');
Route::post('/companies/create', [CompanyController::class, 'create'])->name('companies.create');

//add a new job w/ a form
Route::get('/jobs/add', [JobController::class, 'add'])->name('jobs.add');
//see the job listing details
Route::get('/jobs/{id}', [JobController::class, 'comment'])->name('jobs.comment');
//delete the job
Route::post('/delete/{id}', [JobController::class, 'delete_job'])->name('jobs.delete_job');
//edit the comment for the user
Route::get('/edit_comment/{id}', [JobController::class, 'edit_comment'])->name('jobs.edit_comment');
Route::post('/edit_comment/{id}', [JobController::class, 'update_comment'])->name('jobs.update_comment');
Route::post('/delete_comment/{id}', [JobController::class, 'delete_comment'])->name('jobs.delete_comment');

//create a new job
Route::post('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
//create a new comment for a specific job
Route::post('/jobs/{id}', [JobController::class, 'create_comment'])->name('jobs.create_comment');

Route::get('/jobs/edit/{id}', [JobController::class, 'edit'])->name('jobs.edit');
Route::post('/jobs/update/{id}', [JobController::class, 'update'])->name('jobs.update'); 

Route::post('/jobs/add_favorite/{id}', [JobController::class, 'add_favorite'])->name('jobs.add_favorite');
Route::post('/jobs/remove_favorite/{id}', [JobController::class, 'remove_favorite'])->name('jobs.remove_favorite');


use Illuminate\Support\Facades\URL;

// your routes

if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}