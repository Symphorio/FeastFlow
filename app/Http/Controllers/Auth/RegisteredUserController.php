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
    // Liste des emails des administrateurs
    $adminEmails = [
        'alleluia@gmail.com',
        'admin2@gmail.com',
    ];

    // Validation des données
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Définir le rôle en fonction de l'email
    $role = in_array($validatedData['email'], $adminEmails) ? 'admin' : 'user';

    // Création de l'utilisateur
    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'role' => $role,
    ]);

    // Enregistrement de l'événement et connexion
    event(new Registered($user));
    Auth::login($user);

    // Redirection vers le dashboard approprié
    return $role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
}

}
