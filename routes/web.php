<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\EmployeeController;

Route::get('/user/create',[UserController::class, 'create'])->name('user/create');
Route::post('/user/create',[UserController::class, 'createSubmit'])->name('user/create');

Route::get('/user/view/{id}',[UserController::class,'view']);
Route::get('/user/edit/{id}',[UserController::class,'edit']);
Route::post('/user/edit',[UserController::class,'editSubmit'])->name('user/edit');
Route::get('/user/delete/{id}',[UserController::class,'delete'])->name('user/delete');

Route::get('/user/login',[LoginController::class, 'login']);
Route::post('/user/login',[LoginController::class, 'loginAction']);
Route::get('/user/logout',[LoginController::class, 'logout'])->name('user/logout');
Route::get('/user/profile',[UserProfileController::class, 'userProfile'])->name('user/profile');

Route::get('/employee/create',[EmployeeController::class, 'create'])->name('employee/create');
Route::post('/employee/create',[EmployeeController::class, 'createSubmit'])->name('employee/create');

Route::get('/employee/view/{id}',[EmployeeController::class,'view']);
Route::get('/employee/edit/{id}',[EmployeeController::class,'edit']);
Route::post('/employee/edit',[EmployeeController::class,'editSubmit'])->name('employee/edit');
Route::get('/employee/delete/{id}',[EmployeeController::class,'delete'])->name('employee/delete');
Route::get('/employee/salary',[EmployeeController::class,'salary'])->name('employee/salary');


Route::get('/salary/list',[EmployeeController::class, 'salarylist'])->name('salary/list');
Route::get('/employee/list',[EmployeeController::class, 'list'])->name('employee/list');
Route::get('/user/list',[UserController::class, 'list'])->name('user/list');