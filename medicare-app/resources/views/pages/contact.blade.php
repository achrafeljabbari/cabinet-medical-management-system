@extends('layouts.app')
@section('title', 'Rendez-vous')

@section('content')

<section class="page-hero-mini">
    <div class="page-hero-mini-content">
        <span class="page-breadcrumb">
            <a href="{{ route('home') }}">Accueil</a>
            <i class="fas fa-chevron-right"></i>
            <span>Rendez-vous</span>
        </span>
        <h1 class="page-hero-title">
            <i class="fas fa-calendar-check"></i>
            Prendre Rendez-vous
        </h1>
        <p class="page-hero-subtitle">Réservez votre consultation en ligne en quelques clics</p>
    </div>
    <div class="page-hero-bg"></div>
</section>

<section class="section contact-section">
    <div class="section-container">

        @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
        @endif

        <div class="contact-content">
            <!-- Infos -->
            <div class="contact-info">

                <div class="section-header" style="margin-bottom:2rem">
                    <span class="section-number">01</span>
                    <h2 class="section-title" style="font-size:1.6rem">
                        <span class="title-text">Nous Contacter</span>
                    </h2>
                </div>

                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                    <div class="contact-details">
                        <h4 class="contact-label">Téléphone</h4>
                        <a href="tel:+212522001122" class="contact-value">+212 522 00 11 22</a>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div class="contact-details">
                        <h4 class="contact-label">Email</h4>
                        <a href="mailto:contact@medicare.ma" class="contact-value">contact@medicare.ma</a>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="contact-details">
                        <h4 class="contact-label">Adresse</h4>
                        <span class="contact-value">12 Rue Ibn Sina, Casablanca 20250</span>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-clock"></i></div>
                    <div class="contact-details">
                        <h4 class="contact-label">Horaires</h4>
                        <span class="contact-value">Lun–Sam : 08h00 – 19h00</span>
                    </div>
                </div>

                <div class="contact-item emergency-item">
                    <div class="contact-icon emergency-icon"><i class="fas fa-ambulance"></i></div>
                    <div class="contact-details">
                        <h4 class="contact-label">Urgences</h4>
                        <a href="tel:+212522001199" class="contact-value">+212 522 00 11 99</a>
                        <span class="emergency-badge">24h / 7j</span>
                    </div>
                </div>

            </div>

            <!-- Formulaire -->
            <div class="contact-form-wrapper">
                <div class="section-header" style="margin-bottom:2rem">
                    <span class="section-number">02</span>
                    <h2 class="section-title" style="font-size:1.6rem">
                        <span class="title-text">Demande de Rendez-vous</span>
                    </h2>
                </div>

                <form class="contact-form" method="POST" action="{{ route('contact.submit') }}" id="contactForm">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nom complet *</label>
                            <input type="text" name="nom" class="form-input @error('nom') input-error @enderror"
                                   placeholder="Votre nom complet"
                                   value="{{ old('nom') }}" required>
                            @error('nom')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Téléphone *</label>
                            <input type="tel" name="telephone" class="form-input @error('telephone') input-error @enderror"
                                   placeholder="06 XX XX XX XX"
                                   value="{{ old('telephone') }}" required>
                            @error('telephone')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input"
                               placeholder="votre@email.com"
                               value="{{ old('email') }}">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Spécialité *</label>
                            <select name="specialite" class="form-input form-select" required>
                                <option value="">Choisir une spécialité</option>
                                <option value="generaliste" {{ old('specialite') == 'generaliste' ? 'selected' : '' }}>Médecine Générale</option>
                                <option value="cardio" {{ old('specialite') == 'cardio' ? 'selected' : '' }}>Cardiologie</option>
                                <option value="pediatrie" {{ old('specialite') == 'pediatrie' ? 'selected' : '' }}>Pédiatrie</option>
                                <option value="neuro" {{ old('specialite') == 'neuro' ? 'selected' : '' }}>Neurologie</option>
                                <option value="autre" {{ old('specialite') == 'autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                            @error('specialite')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date souhaitée</label>
                            <input type="date" name="date" class="form-input"
                                   min="{{ date('Y-m-d') }}"
                                   value="{{ old('date') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Motif de la consultation</label>
                        <textarea name="motif" class="form-input form-textarea"
                                  rows="4"
                                  placeholder="Décrivez brièvement votre motif de consultation...">{{ old('motif') }}</textarea>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" id="rgpd" name="rgpd" required>
                        <label for="rgpd">
                            J'accepte que mes données soient traitées conformément à la
                            <a href="#" class="form-link">politique de confidentialité</a> de Medicare.
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-submit" id="submitBtn">
                        <span>Envoyer la demande</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>

@endsection
