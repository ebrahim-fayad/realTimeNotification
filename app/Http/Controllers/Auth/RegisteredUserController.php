<?php

namespace App\Http\Controllers\Auth;

use App\Events\NewUserRegisteredEvent;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Notifications\NewUserRegisterNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        $admin = Admin::findOrFail(1);
        $admin->notify(new NewUserRegisterNotification($user));
        // Dispatch the event to notify all admins
        NewUserRegisteredEvent::dispatch($user);
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
