<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

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
    return view('auth/login');
});

Route::get('register',[RegisterController::class,'register_user']);
Route::post('insert',[RegisterController::class,'insert_user']);
Route::get('login',[RegisterController::class,'login_Form'])->name('login');
Route::post('login_user',[RegisterController::class,'login_user']);

Route::middleware(['auth'])->group(function(){
    Route::get('dashboard',[RegisterController::class,'dashboard']);
    Route::get('posts',[RegisterController::class,'all_post'])->name('allpost');
    Route::post('image-post',[RegisterController::class,'imagepost'])->name('addpost');
    Route::post('/delete/{id}', [RegisterController::class,'delete'])->name('delete');
    Route::get('postupdata/{id}',[RegisterController::class,'postupdata']);
    Route::post('updatepost',[RegisterController::class,'updatepost'])->name('updatepost');
    Route::post('logout',[RegisterController::class,'Logout'])->name('logout');
});



