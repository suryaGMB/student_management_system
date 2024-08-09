<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class UserLogin extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
            'user_type' => 'users' 
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('user.dashboard'); 
        } else {
            session()->flash('error', 'Invalid credentials!');
        }
    }
    public function render()
    {
        return view('livewire.user-login');
    }
}
