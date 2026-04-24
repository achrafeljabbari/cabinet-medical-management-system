<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', ['title' => 'Accueil']);
    }

    public function about()
    {
        return view('pages.about', ['title' => 'À Propos']);
    }

    public function services()
    {
        return view('pages.services', ['title' => 'Nos Services']);
    }

    public function equipe()
    {
        return view('pages.equipe', ['title' => 'Notre Équipe']);
    }

    public function temoignages()
    {
        return view('pages.temoignages', ['title' => 'Témoignages']);
    }

    public function contact()
    {
        return view('pages.contact', ['title' => 'Rendez-vous']);
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'nom'        => 'required|string|min:2|max:100',
            'telephone'  => 'required|string|min:8|max:20',
            'email'      => 'nullable|email|max:255',
            'specialite' => 'required|string',
            'date'       => 'nullable|date|after_or_equal:today',
            'motif'      => 'nullable|string|max:1000',
            'rgpd'       => 'accepted',
        ], [
            'nom.required'        => 'Le nom est obligatoire.',
            'telephone.required'  => 'Le téléphone est obligatoire.',
            'specialite.required' => 'Veuillez choisir une spécialité.',
            'rgpd.accepted'       => 'Vous devez accepter notre politique de confidentialité.',
        ]);

        // TODO: envoyer email / sauvegarder en DB
        // Mail::to('contact@medicare.ma')->send(new RdvRequest($validated));

        return redirect()->route('contact')
            ->with('success', 'Votre demande de rendez-vous a bien été envoyée. Nous vous contacterons dans les 24h.');
    }
}
