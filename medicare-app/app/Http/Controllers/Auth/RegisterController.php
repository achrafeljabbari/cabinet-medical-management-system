<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Afficher le formulaire d'inscription
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Traiter l'inscription d'un nouveau patient
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'          => ['required', 'string', 'min:2', 'max:100'],
            'email'         => ['required', 'email', 'max:255', 'unique:users,email'],
            'telephone'     => ['nullable', 'string', 'max:20'],
            'date_naissance'=> ['nullable', 'date', 'before:today'],
            'medecin_traitant' => ['nullable', 'string', 'max:100'],
            'password'      => ['required', 'confirmed', Password::min(8)],
            'terms'         => ['accepted'],
        ], [
            'name.required'      => 'Le nom complet est obligatoire.',
            'name.min'           => 'Le nom doit contenir au moins 2 caractères.',
            'email.required'     => 'L\'adresse email est obligatoire.',
            'email.email'        => 'Veuillez entrer une adresse email valide.',
            'email.unique'       => 'Cette adresse email est déjà utilisée.',
            'password.required'  => 'Le mot de passe est obligatoire.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.min'       => 'Le mot de passe doit contenir au moins 8 caractères.',
            'terms.accepted'     => 'Vous devez accepter les conditions d\'utilisation.',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home');
    }
}
