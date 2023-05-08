<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class NotaController extends Controller
{


    public function store(Request $request)
    {
        $nota = new Nota;
        $nota->nota = $request->nota;
        $nota->user_id = Auth::id(); // Asignar el ID de usuario actual
        $nota->save();
        return back();
    }

    public function trending()
    {
        $notes = Nota::withCount('likes')
            ->orderByDesc('likes_count')
            ->take(10)
            ->get();

        return view('trending', compact('notes'));
    }
}
