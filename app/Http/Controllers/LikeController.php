<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Nota;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nota = Nota::find($request->input('nota_id'));
    
        if (!$nota) {
            abort(404);
        }
    
        $user = Auth::user();
    
        if ($nota->likes()->where('user_id', $user->id)->exists()) {
            return back()->withErrors(['Ya has dado like a esta nota.']);
        }
    
        $like = new Like();
        $like->user_id = $user->id;
        $like->nota_id = $nota->id;
        $like->save();
    
        return back();
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nota $nota)
    {
        $user = Auth::user();
    
        $like = $nota->likes()->where('user_id', $user->id)->first();
    
        if (!$like) {
            abort(404);
        }
    
        $like->delete();
    
        return back();
    }
    
}
