<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('auth/redirection/{provider}', function ($provider) {
    if($provider){
        return Socialite::driver($provider)->redirect();
    } else {
        abort(404);
    }

})->name('auth.redirection');


Route::get('auth/{provider}/callback', function ($provider) {
    try {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        $user = User::where('auth_provider_id', $socialUser->id)->orWhere('email', $socialUser->email)->first();

        if ($user) {
            Auth::login($user);
        } else {
            $user = User::create([
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => Hash::make('Password@123'), // Default/fake password
                'auth_provider' => $provider,
                'auth_provider_id' => $socialUser->id,
            ]);

            Auth::login($user);
        }

        return redirect()->route('dashboard')->with('success', "Login successful via {$provider}");
    } catch (\Throwable $th) {
        return redirect()->route('register')->with('error', 'Authentication failed.');
    }
})->name('auth.callback');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});
require __DIR__ . '/auth.php';
