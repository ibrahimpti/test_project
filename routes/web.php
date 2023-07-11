<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home',[userController::class,'index']);
Route::post('/home',[userController::class,'store']);
Route::delete('/home/{id}', [userController::class, 'destroy'])->name('post.delete');
//Route::get('/update/{id}',function (){
//    return view('components.update');
//});


Route::get('/update/{id}', [userController::class, 'edit'])->name('post.edit');
Route::put('/update/{id}', [userController::class, 'update'])->name('post.update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [userController::class, 'index'])->name('home');
Auth::routes();
Route::post('/custom-login', [userController::class, 'login'])->name('custom.login');

Route::get('/register',function (){
    return view('auth.register');
});
Route::post('/custom-register', [userController::class, 'storer'])->name('custom.register');
Route::get('/login1',function (){
   return view('components.login1');
});
