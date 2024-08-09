<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

#[Title('Login')] 
class Login extends Component
{
    #[Validate('required|email')]
    public $email;

    #[Validate('required')]
    public $password;

    public function login()
    {
    // dd('hi');

        $this->validate();
    
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->user_type === 'admin') {
                session()->flash('message', 'You have successfully logged in!');
                return redirect()->route('dashboard');
            } 
             else {
                return redirect()->route('user.dashboard');
            }
        } else {
            session()->flash('error', 'Invalid credentials!');
        }
    }  

    // public function userlogin()
    // {
    //     $this->validate();
    
    //     $credentials = [
    //         'email' => $this->email,
    //         'password' => $this->password,
    //         'user_type' => 'users' 
    //     ];
    
    //     if (Auth::attempt($credentials)) {
    //         return redirect()->route('user.dashboard'); 
    //     } else {
    //         session()->flash('error', 'Invalid credentials!');
    //     }
    // }
    public function render()
    {
        return view('livewire.login');
    }
}
