<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;

class Login extends Component
{
    public $email       = "";
    public $password    = "";

    public function submit() {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email' => $this->email, 'password' => $this->password, 'user_type' => 'admin'])){
            return redirect('/');
        }
        $this->addError('login-failed', 'Incorrect username & password!');
    }

    public function render()
    {
        return view('livewire.login')->layout('layouts.login');
    }
}
