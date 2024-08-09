<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\ForgotPasswordMail;



class ForgotPassword extends Component
{
    public $email;
    public $otp;
    public $showOtpForm = false;
    public $confirmPassword;
    public $newPassword;
    public $showResetForm = false;
    public $showpassword = false;
    public $successMessage;

    public function sendOtp()
    {

        $this->validate(['email' => 'required|email']);


        $user = User::where('email', $this->email)->first();
        if ($user) {
            
            $otp = mt_rand(100000, 999999);
            $user->update(['otp_for_password_reset' => $otp]);
            Mail::to($user->email)->send(new ForgotPasswordMail($otp));
            $this->showOtpForm = true;
        } else {
            $this->addError('email', 'User not found with this email address.');
        }
    }

    public function verifyOtp()
    {
        // dd($this->email,$this->otp);
        $user = User::where('email', $this->email)->where('otp_for_password_reset', $this->otp)->first();
        // dd($user);
        if ($user) {

            $this->showpassword = true;
        } else {

            session()->flash('error', 'Invalid OTP. Please try again.');
        }
    }

    public function resetPassword()
    {
        $this->validate([
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|same:newPassword',
        ]);

        $user = User::where('email', $this->email)->first();

        if ($user) {
            $user->update(['password' => Hash::make($this->newPassword), 'otp_for_password_reset' => null]);
            $this->reset(['newPassword', 'confirmPassword']);
            $this->successMessage = 'Password changed successfully!';
        } else {
            session()->flash('error', 'User not found.');
        }
    }


    public function render()
    {
        return view('livewire.forgot-password');
    }
}
