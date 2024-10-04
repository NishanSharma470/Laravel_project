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
        $messages = [
            'password.required' => 'A password is required.',
            'password.confirmed' => 'Passwords must match.',
            'password.min' => 'Password must be at least :min characters long.',
            'password.regex' => 'Password must include at least one lowercase letter, one uppercase letter, one number, and one special character.',
        ];

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed',  'regex:/[a-z]/',  'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*?&]/'],
            'usertype' => ['required', 'in:internal,external'],
        ],$messages);

        

        if ($request->usertype === 'internal') {
            $request->validate([
                'department' => ['required', 'string', 'max:255'],
            ]);
        } elseif ($request->usertype === 'external') {
            $request->validate([
                'company' => ['required', 'string', 'max:255'],
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'usertype' => $request->usertype,
            'password' => Hash::make($request->password),
            'company' => $request->usertype === 'external' ? $request->company : null,
            'department' => $request->usertype === 'internal' ? $request->department : null,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
