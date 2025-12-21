<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPassword extends Component
{
    public string $token;
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(string $token)
    {
        $this->token = $token;
        $this->email = request()->query('email', '');
    }

    protected function rules()
    {
        return [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ];
    }

    public function resetPassword()
    {
        $this->validate();

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            session()->flash('success', 'Password reset successfully.');
            return redirect()->route('login');
        }

        $this->dispatch(
            'mega-error',
            message: __($status)
        );
    }

    #[Layout('components.layouts.guest.guest-layout')]
    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
