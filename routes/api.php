<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryAPIController;

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

Route::get('/user/list',[InventoryAPIController::class, 'list'])->name('user/list');
Route::get('/employee/list',[InventoryAPIController::class, 'employeeList']);
Route::get('/salary/list',[InventoryAPIController::class, 'salarylist']);
Route::post('/user/create',[InventoryAPIController::class, 'createSubmit']);
Route::post('/employee/salary',[InventoryAPIController::class,'salary']);
Route::delete('/user/delete/{id}',[InventoryAPIController::class,'Userdelete']);
Route::post('/employee/create',[InventoryAPIController::class, 'ecreateSubmit']);
Route::delete('/employee/delete/{id}',[InventoryAPIController::class,'delete']);

Route::post('/user/edit',[InventoryAPIController::class,'editSubmit']);
Route::get('/user/view/{id}',[InventoryAPIController::class,'view']);

Route::post('/employee/edit',[InventoryAPIController::class,'EeditSubmit']);
Route::get('/employee/view/{id}',[InventoryAPIController::class,'employeeView']);

Route::post('/user/login',[InventoryAPIController::class, 'login']);
Route::get('/user/logout',[InventoryAPIController::class, 'logout']);








