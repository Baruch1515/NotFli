<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\InicioController;

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Route;
use App\Models\Nota;

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


Route::middleware('auth')->group(function () {
  Route::get('/dashboard', [InicioController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users/{user}', [ProfileController::class, 'show'])->name('perfil.show');
    Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('perfil.edit');
  Route::put('/perfil/{id}', [ProfileController::class, 'update'])->name('perfil.update');


    Route::delete('/posts/{id}', [NotaController::class, 'destroy'])->name('posts.destroy');


    Route::get('/buscar', [InicioController::class, 'busqueda'])->name('search.index');



    Route::post('/users/{user}/follow', [FollowController::class, 'follow'])->name('follow');
    Route::delete('/users/{user}/unfollow', [FollowController::class, 'destroy'])->name('unfollow');
    
    Route::delete('likes/{nota}', [LikeController::class, 'destroy'])->name('likes.destroy');
    Route::post('/likes}', [LikeController::class, 'store'])->name('likes.store');


    Route::get('/hashtag/{tag}', [NotaController::class, 'notasPorHashtag'])->name('notas.hashtag');
    Route::get('trending', [NotaController::class, 'trending'])->name('user.show');
    Route::get('/trending', [NotaController::class, 'trending'])->name('trending');
    Route::get('/repost/{nota}', [NotaController::class, 'repost'])->name('repost.show');
    Route::post('/guardar-nota', [NotaController::class, 'store'])->name('guardar.nota');

});



require __DIR__ . '/auth.php';
