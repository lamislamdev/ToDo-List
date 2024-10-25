<?php


use App\Http\Controllers\PageController;
use App\Http\Controllers\Todo\TodoController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


//Route::get('/', [PageController::class, 'home'])->name('home');


Route::get('/', function (){
    return inertia::render('Home');
});
Route::get('/login-x', function (){
    return inertia::render('login');
});

Route::post('/user-register', [UserController::class, 'register'])->name('user-register');
Route::post('/user-login', [UserController::class, 'login'])->name('user-login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::put('/update-user', [UserController::class, 'updateUser'])->name('update-user');
Route::delete('/delete-user', [UserController::class, 'deleteUser'])->name('delete-user');


Route::post('/add-todo', [TodoController::class , 'addTodo'])->name('add-todo');
Route::get('/today-todo', [TodoController::class , 'toadyTodo'])->name('today-todo');
Route::patch('/check-todo', [TodoController::class , 'checkTodo'])->name('check-todo');
Route::delete('/delete-todo', [TodoController::class , 'deleteTodo'])->name('delete-todo');

