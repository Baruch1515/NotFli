<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        $user = Auth::user();
    
        return view('editarperfil',compact('user'));
    }
    

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, $id)
    {
        // Obtener el perfil que se va a actualizar
        $perfil = User::findOrFail($id);
    
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$perfil->id],
            'imagen' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'] // Añade la validación para la imagen
        ]);
    
        // Actualizar el perfil con los nuevos datos
        $perfil->name = $request->name;
        $perfil->email = $request->email;
    
        if (!empty($request->birthay)) {
            $perfil->birthay = $request->birthay;
        }
    
        if (!empty($request->orientacion)) {
            $perfil->orientacion = $request->orientacion;
        }
    
        if (!empty($request->pais)) {
            $perfil->pais = $request->pais;
        }
    
        // Verificar si se cargó una nueva imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $rutaImagen = 'images/fotosdeperfil/' . $nombreImagen;
            $imagen->move('images/fotosdeperfil', $nombreImagen);
            $perfil->imagen = $rutaImagen;
        }
        
    
        $perfil->save();
    
        // Redirigir al usuario de vuelta a su perfil con un mensaje de éxito
        return back()->with('success', 'Perfil actualizado correctamente');
    }
    
    
    

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function show($name)
    {
        $user = User::where('name', $name)->firstOrFail();
        $fechaNacimiento = date_format(date_create($user->birthday), 'F Y');
        $isOwner = Auth::check() && Auth::user()->id == $user->id; // Corregir la comparación
        return view('perfil', compact('user', 'isOwner'));
    }
    
    

}
