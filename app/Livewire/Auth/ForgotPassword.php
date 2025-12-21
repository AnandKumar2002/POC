<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ForgotPassword extends Component
{
    public string $email = '';

    protected function rules()
    {
        return [
            'email' => ['required', 'email'],
        ];
    }

    public function sendResetLink()
    {
        $this->validate();

        $status = Password::sendResetLink([
            'email' => $this->email,
        ]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->dispatch(
                'mega-success',
                message: 'Password reset link sent to your email address.'
            );

            $this->reset([
                'email',
            ]);

            return;
        }

        $this->dispatch(
            'mega-error',
            message: __($status)
        );
    }


    #[Layout('components.layouts.guest.guest-layout')]
    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
