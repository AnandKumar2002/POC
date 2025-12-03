<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DeleteAccount extends Component
{
    public $password = '';

    protected $rules = [
        'password' => 'required',
    ];

    public function deleteAccount()
    {
        $this->validate();

        $user = Auth::user();

        if (! Hash::check($this->password, $user->password)) {
            $this->addError('password', 'The password is incorrect.');
            return; // modal will STAY OPEN
        }

        // Delete account
        $user->delete();

        Auth::logout();

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.delete-account');
    }
}
