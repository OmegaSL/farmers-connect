<?php

namespace App\Livewire\Guest\Modal;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ShopCartAuthComponent extends Component
{
    use LivewireAlert;

    public mixed $name = '';
    public mixed $email = '';
    public mixed $password = '';
    public bool $remember = false;

    public bool $signing_in = true;
    public bool $signing_up = false;
    public bool $is_logged_in = false;

    public function render()
    {
        return view('livewire.guest.modal.shop-cart-auth-component');
    }

    public function signup()
    {
        $this->signing_in = false;
        $this->signing_up = true;
    }

    public function signin()
    {
        $this->signing_in = true;
        $this->signing_up = false;
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
            $this->is_logged_in = true;

            $this->dispatch('isLoggedIn');

            $this->reset(['email', 'password']);
        } else {
            $this->alert('error', 'Login Failed');
            $this->is_logged_in = false;
        }
    }

    public function signupSubmit()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $user = auth()->guard('guest')->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember);

        if ($user) {
            $this->alert('success', 'Login Successful');
            $this->is_logged_in = true;

            $this->dispatch('isLoggedIn');

            $this->reset(['name', 'email', 'password']);
        } else {
            $this->alert('error', 'Login Failed');
            $this->is_logged_in = false;
        }
    }
}
