@extends('layouts.app')
@section('title', 'Mon Profil')

@section('content')
<section class="page-hero-mini">
    <div class="page-hero-mini-content">
        <span class="page-breadcrumb">
            <a href="{{ route('home') }}">Accueil</a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('dashboard') }}">Mon Espace</a>
            <i class="fas fa-chevron-right"></i>
            <span>Profil</span>
        </span>
        <h1 class="page-hero-title">
            <i class="fas fa-user-edit"></i>
            Mon Profil
        </h1>
        <p class="page-hero-subtitle">Gérez vos informations personnelles</p>
    </div>
    <div class="page-hero-bg"></div>
</section>

<section class="section">
    <div class="section-container" style="max-width:700px">
        @if(session('success'))
        <div class="alert-success" style="margin-bottom:2rem">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="contact-form">
            @csrf @method('PATCH')
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nom complet</label>
                    <input type="text" name="name" class="form-input"
                           value="{{ old('name', Auth::user()->name) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input"
                           value="{{ old('email', Auth::user()->email) }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                <input type="password" name="password" class="form-input" placeholder="Nouveau mot de passe">
            </div>
            <div class="form-group">
                <label class="form-label">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" class="form-input" placeholder="Confirmer">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Enregistrer
            </button>
        </form>
    </div>
</section>
@endsection
