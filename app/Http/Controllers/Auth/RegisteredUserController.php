<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Strict Validation for Name
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                // Regex explanation: 
                // ^[a-zA-Z]{3,}  -> Starts with 3 or more letters
                // \s             -> Followed by exactly ONE space
                // [a-zA-Z]{3,}$  -> Ends with 3 or more letters
                // This strictly enforces exactly two names, no numbers, no special chars, no extra spaces.
                'regex:/^[a-zA-Z]{3,}\s[a-zA-Z]{3,}$/' 
            ],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            // Custom error message for the regex
            'name.regex' => 'The name must contain exactly two names (e.g., Fadhila Salumu). Each name must be at least 3 letters long and contain only letters.',
        ]);

        // 2. Format Name to Title Case (e.g., "fadhila salumu" -> "Fadhila Salumu")
        // We use trim() just to be absolutely safe, though regex already prevents leading/trailing spaces.
        $formattedName = Str::title(trim($request->name));

        // 3. Create User
        $user = User::create([
            'name' => $formattedName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}