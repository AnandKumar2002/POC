<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;


class ImpersonationController extends Controller
{
    public function startImpersonation(User $user)
    {
        Gate::authorize('impersonate', $user);

        // if (!$user->is_active) {
        //     return back()->with('error', 'User Inactive!');
        // }

        Session::put('impersonate.admin_id', Auth::id());

        Auth::login($user);

        return redirect('/dashboard')->with('success', 'You are now impersonating another user.'); // or wherever you want to land after impersonation
    }

    public function stopImpersonation()
    {
        if (! Session::has('impersonate.admin_id')) {
            abort(403, 'You are not impersonating.');
        }

        $adminId = Session::pull('impersonate.admin_id');

        $admin = User::find($adminId);

        if (! $admin) {
            Auth::logout();
            return redirect('/login')->with('error', 'Original admin not found.');
        }

        Auth::login($admin);

        return redirect('/dashboard')->with('success', 'Switched back to super admin.'); 
    }
}
