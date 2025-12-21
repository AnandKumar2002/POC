<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $credentials = $this->validate();

        if (! Auth::attempt($credentials, $this->remember)) {
            $this->addError('email', 'The provided credentials do not match our records.');
            return;
        }

        session()->regenerate();

        session()->flash('success', 'Welcome back');

        $user = Auth::user();
        if ($user->hasAnyRole(['super-admin', 'admin'])) {
            return redirect()->intended('/admin-dashboard');
        }

        return redirect()->intended('/dashboard');
    }

    #[Layout('components.layouts.guest.guest-layout')]
    public function render()
    {
        return view('livewire.auth.login');
    }
}
