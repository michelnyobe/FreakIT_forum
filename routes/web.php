<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\RubriqueController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CategorieController;
use App\Models\User;

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

Route::get('/', [ForumController::class, 'showForum']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [RubriqueController::class, 'index'])->name('dashboard');
    
    
    
    Route::resource('post', RubriqueController::class);
    Route::resource('commentaire', CommentaireController::class);
    
Route::get('/testregister',function(){
    return view('forum.testregister');
});
Route::get('home',[ForumController::class, 'redirection']);

Route::resource('categories', CategorieController::class);
Route::get('/test',function(){
    return view('test');
});

Route::put('/user/{id}', [ForumController::class, 'userUpdate'])->name('userUpdate');
Route::get('/userlist', [ForumController::class, 'userlist'])->name('userlist');
Route::get('/statistiques', [ForumController::class, 'userCreationChart']);
Route::get('/userlist', [ForumController::class, 'userlist'])->name('userlist');
Route::delete('/user/{id}',[ForumController::class , 'userDelete'])->name('user.destroy');
route::get('autocomplete/', [ForumController::class, 'search'])->name('rubriques.search');

});



    
     // Exemple de route pour l'administrateur

