<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\RubriqueController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CategorieController;


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

Route::get('/', [RubriqueController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    
    Route::resource('post', RubriqueController::class);
    Route::resource('commentaire', CommentaireController::class);
});

// route 
Route::get('/testregister',function(){
    return view('forum.testregister');
});
Route::get('home',[ForumController::class, 'redirection']);
Route::get('/home',function(){
    return view('dashboardUser');
});
Route::get('/home',function(){
    return view('dashboardUser');
});
Route::resource('categories', CategorieController::class);
Route::get('/test',function(){
    return view('test');
});
Route::get('/userlist', [ForumController::class, 'userlist']);
Route::get('/statistiques', [ForumController::class, 'userCreationChart']);