<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssignedTaskController;
use App\Http\Controllers\SubmittedTaskController;



//this for the user controller 
Route::get('/', function () {return view('welcome');})->name('welcome');


Route::post('/register', [UserController::class, 'register'])->name('register')->middleware('auth');
Route::post('login', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
Route::put('/updateUser/{id}',[UserController::class, 'updateUser'])->name('updateUser')->middleware('auth');
Route::get('/retrieveUsers/{id}',[UserController::class, 'retrieveUsers'])->name('retrieveUsers')->middleware('auth');
Route::get('/users/{id}', [UserController::class, 'destroy'])->name('usersDestroy')->middleware('auth');



//this for assigned task controller routes
Route::post('/AssignTask/{userId}',[AssignedTaskController::class, 'assignTask'])->name('assignTask')->middleware('auth');
Route::get('/myAssignedTask/{userId}',[ AssignedTaskController::class,'myAssignedTask'])->name('myAssignedTask')->middleware('auth');
Route::get('/AssignedTask/{userId}/{managerId}',[ AssignedTaskController::class,'showAssignedTasks'])->name('AssignedTask')->middleware('auth');
Route::get('/distroyTask/{id}',[AssignedTaskController::class,'deleteAssignedTask'])->name('distroyTask')->middleware('auth');



//this is for submited task controller routes
Route::post('/feedback/{submitId}',[SubmittedTaskController::class,'feadback'])->name('feedback')->middleware('auth');
Route::post('/submitTask/{taskid}/user/{userId}',[SubmittedTaskController::class, 'submitTask'])->name('submitTask')->middleware('auth');
Route::get('/mySubmition/{taskId}/{userId}',[ SubmittedTaskController::class,'mySubmition'])->name('mySubmition')->middleware('auth');
Route::get('/SubmitedTask/{taskId}/user/{userId}/manager/{managerId}',[SubmittedTaskController::class,'SubmitedTask'])->name('SubmitedTask')->middleware('auth');








