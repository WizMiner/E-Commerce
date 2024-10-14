<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Login')]
class LoginPage extends Component
{

    public $email;
    public $password;

    //login user

    public function save(){
        $this->validate([
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required|min:4|max:255',

        ]);

        if (!\Illuminate\Support\Facades\Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->flash('errors', 'Invalid credentials');
            return;
        }
    }

    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
