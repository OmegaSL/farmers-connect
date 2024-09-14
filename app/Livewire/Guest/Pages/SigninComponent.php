<?php

namespace App\Livewire\Guest\Pages;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SigninComponent extends Component
{
    use LivewireAlert;

    public $email;
    public $password;
    public $otp_code;
    public $remember = false;

    public $reset_password = false;
    public $sign_in = true;
    public $enter_otp = false;

    public $new_password;
    public $confirm_password;

    public function mount()
    {
        if (auth()->guard('guest')->check()) {
            return redirect()->route('user.orders');
        }
    }

    public function render()
    {
        return view('livewire.guest.pages.signin-component')->extends('livewire.guest.layouts.auth');
    }

    public function loginSubmit()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = auth()->guard('guest')->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember);

        if ($user) {
            $this->alert('success', 'Login Successful');
            $this->reset(['email', 'password']);

            return redirect()->intended(route('user.orders'));
        } else {
            $this->alert('error', 'Login Failed');
        }
    }

    public function forgotPassword()
    {
        $this->sign_in = false;
        $this->reset_password = true;
        $this->email = '';
        $this->password = '';
        $this->remember = false;
    }

    public function signIn()
    {
        $this->sign_in = true;
        $this->reset_password = false;
        $this->email = '';
        $this->password = '';
        $this->remember = false;
    }

    public function forgotPasswordSubmit()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        try {
            DB::beginTransaction();
            // get the user and update the otp field
            $otp_code = rand(10000, 99999);
            $user = User::query()->where('email', $this->email)->first();
            $user->update([
                'otp' => $otp_code,
                'otp_expires_at' => now()->addMinutes(5),
            ]);

            $data = [
                'otp_code' => $otp_code,
                'otp_expires_at' => now()->addMinutes(5),
            ];

            // send an otp to the email
            Mail::send('emails.forgot-password-mail', $data, function ($message) {
                $message->to($this->email)->subject('Reset Password Code');
                $message->from(config('mail.from.address'), config('app.name'));
            });

            $this->reset_password = false;
            $this->sign_in = false;
            $this->enter_otp = true;

            DB::commit();

            $this->alert('success', 'OTP Sent to ' . $this->email);
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->alert('error', $exception->getMessage());
            return;
        }
    }

    public function resetPassword()
    {
        $this->validate([
            'email' => 'required|exists:users,email',
            'otp_code' => 'required|exists:users,otp',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:new_password',
        ]);

        $user = User::where('email', $this->email)
            ->where('otp', $this->otp_code)
            ->first();
        if (!$user) {
            $this->alert('error', 'The OTP Code provided do not match this email');
        }

        if ($user->otp_expires_at < now()) {
            $this->alert('info', 'The provided OTP Code has expired!');
        }

        $user->update([
            'password' => Hash::make($this->new_password),
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        $this->reset(['email', 'otp_code', 'new_password', 'confirm_password', 'reset_password', 'sign_in', 'enter_otp']);

        $this->alert('success', 'Password Reset Successful');
    }
}
