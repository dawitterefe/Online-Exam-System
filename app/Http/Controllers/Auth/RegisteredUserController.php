<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->first_name,
            'father_name' => $request->last_name,
            'gender' => $request->input('gender'),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => 'storage/avatar/avatar.png',
            'role_id' => 2,
        ]);

        event(new Registered($user));

        Auth::login($user);

        if(Auth::user()->hasRole('Admin'))
        {
            return redirect(to: '/admin');

        }
        elseif(Auth::user()->hasRole('Student'))
        {
            return redirect(to: '/student');
        }

        elseif(Auth::user()->hasRole('Teacher'))
        {
            return redirect(to: '/teacher');
        }
        elseif(Auth::user()->hasRole('Exam-Committee'))
        {
            return redirect(to: '/exam-committee');
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
