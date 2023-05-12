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

Route::get('/dashboard', [InicioController::class, 'index'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //APP DE NOTAS
    Route::post('/guardar-nota', [NotaController::class, 'store'])->name('guardar.nota');

    Route::post('/likes}', [LikeController::class, 'store'])->name('likes.store');

    Route::get('/users/{user}', [ProfileController::class, 'show'])->name('perfil.show');

    Route::post('/users/{user}/follow', [FollowController::class, 'follow'])->name('follow');
    Route::delete('/users/{user}/unfollow', [FollowController::class, 'destroy'])->name('unfollow');

    Route::get('trending', [NotaController::class, 'trending'])->name('user.show');
    Route::get('/trending', [NotaController::class, 'trending'])->name('trending');
    Route::delete('likes/{nota}', [LikeController::class, 'destroy'])->name('likes.destroy');

  

    Route::get('/hashtag/{tag}', [NotaController::class, 'notasPorHashtag'])->name('notas.hashtag');

    Route::get('/repost/{nota}', [NotaController::class, 'repost'])->name('repost.show');
});



require __DIR__ . '/auth.php';
