<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $validatedData = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validatedData)) {
            return redirect()->intended('/dashboard');
        }

        $this->addError('email', 'Estas credenciales no coinciden con nuestros registros.');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
