<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Models\Nota;
use Illuminate\Support\Facades\Auth;

class InicioController extends Controller
{
    //
    public function index()
    {
        $notes = Nota::withCount('likes')
            ->orderByDesc('likes_count')
            ->take(5)
            ->get();

        $notas = Nota::orderBy('created_at', 'desc')->get();
        foreach ($notas as $nota) {
            $contenido = $nota->nota;

            // Buscar hashtags en el contenido y convertirlos en enlaces
            $contenido = preg_replace_callback('/#(\w+)/', function ($matches) {
                $tag = $matches[1];
                return '<a style="color:#1d9bf0;" href="' . route('notas.hashtag', ['tag' => $tag]) . '">#' . $tag . '</a>';
            }, $contenido);

            // Actualizar el contenido de la nota
            $nota->nota = $contenido;
        }

        $user = Auth::user();
        return view('dashboard', compact('notas', 'notes', 'user'));
    }
}
