<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class NotaController extends Controller
{

    public function repost($id)
    {
        $nota = Nota::findOrFail($id);
        return view('repostear', compact('nota'));
    }

    public function store(Request $request)
    {
        
        $nota = new Nota;
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $rutaImagen = 'images/fotospublicacion/' . $nombreImagen;
            $imagen->move('images/fotospublicacion', $nombreImagen);
            $nota->imagen = $rutaImagen;
        }
        $nota->nota = $request->nota;
        $nota->user_id = Auth::id(); // Asignar el ID de usuario actual
        $nota->save();
        return back();
    }
    
    public function notasPorHashtag($tag)
    {
        $notes = Nota::withCount('likes')
            ->orderByDesc('likes_count')
            ->take(5)
            ->get();
        $user = Auth::user();
        // Buscar notas que contengan el hashtag especificado
        $notas = Nota::where('nota', 'LIKE', "%$tag%")->inRandomOrder()->get();

        // Pasar las notas y el hashtag a la vista
        return view('notas-por-hashtag', compact('notas', 'tag', 'notes', 'user'));
    }



    public function destroy($id)
    {
        $nota = Nota::find($id);
    
        if (!$nota) {
            abort(404);
        }
    
        if ($nota->user_id != auth()->id()) {
            abort(403);
        }
    
        $nota->delete();
    
        return redirect()->back()->with('success', 'La publicación ha sido eliminada correctamente.');
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
