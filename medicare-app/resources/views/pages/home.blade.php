@extends('layouts.app')
@section('title', 'Accueil')

@section('content')

<!-- Hero Section -->
<section id="home" class="hero-section">
    <div class="hero-background">
        <div class="medical-grid-bg"></div>
        <div class="floating-particles" id="particles"></div>
    </div>

    <div class="hero-container">
        <div class="hero-content">
            <div class="hero-greeting">
                <span class="greeting-badge">
                    <i class="fas fa-shield-alt"></i> Soins de confiance depuis 2010
                </span>
            </div>

            <h1 class="hero-name" id="heroName">
                <span class="name-prefix">Cabinet Médical</span>
                <span class="name-value">Medicare</span>
            </h1>

            <div class="hero-title">
                <span class="title-prefix"><i class="fas fa-heartbeat"></i></span>
                <span class="title-text">Médecine Générale & Spécialisée</span>
            </div>

            <p class="hero-description">
                Votre santé est notre priorité. Nous offrons des soins médicaux de haute qualité
                avec une équipe de professionnels dévoués, des équipements modernes et une
                approche centrée sur le patient.
            </p>

            <div class="hero-buttons">
                <a href="{{ route('contact') }}" class="btn btn-primary">
                    <span>Prendre Rendez-vous</span>
                    <i class="fas fa-calendar-plus"></i>
                </a>
                <a href="{{ route('services') }}" class="btn btn-secondary">
                    <span>Nos Services</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="hero-social">
                <a href="tel:+212522001122" class="social-icon" title="Téléphone">
                    <i class="fas fa-phone"></i>
                </a>
                <a href="mailto:contact@medicare.ma" class="social-icon" title="Email">
                    <i class="fas fa-envelope"></i>
                </a>
                <a href="#" class="social-icon" title="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-icon" title="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </div>

        <div class="hero-image-wrapper">
            <div class="hero-image-container">
                <div class="profile-image-glow"></div>
                <div class="profile-image-frame">
                    <div class="profile-image" id="profileImage">
                        <div class="profile-placeholder">
                            <i class="fas fa-user-md"></i>
                        </div>
                    </div>
                </div>
                <div class="floating-badge badge-1">
                    <i class="fas fa-heartbeat"></i>
                    <div class="badge-content">
                        <span class="badge-title">Cardiologie</span>
                        <span class="badge-libs">ECG, Écho, Holter</span>
                    </div>
                </div>
                <div class="floating-badge badge-2">
                    <i class="fas fa-lungs"></i>
                    <div class="badge-content">
                        <span class="badge-title">Pneumologie</span>
                        <span class="badge-libs">Spirométrie, Asthme</span>
                    </div>
                </div>
                <div class="floating-badge badge-3">
                    <i class="fas fa-microscope"></i>
                    <div class="badge-content">
                        <span class="badge-title">Laboratoire</span>
                        <span class="badge-libs">Analyses, Biologie</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="scroll-indicator">
        <div class="scroll-mouse"><div class="scroll-wheel"></div></div>
        <span class="scroll-text">Défiler</span>
    </div>
</section>

<!-- Quick Stats Strip -->
<section class="stats-strip">
    <div class="stats-strip-container">
        <div class="strip-stat">
            <i class="fas fa-users"></i>
            <div>
                <span class="strip-number" data-count="5000">0</span><span>+</span>
                <span class="strip-label">Patients suivis</span>
            </div>
        </div>
        <div class="strip-divider"></div>
        <div class="strip-stat">
            <i class="fas fa-calendar-check"></i>
            <div>
                <span class="strip-number" data-count="14">0</span>
                <span class="strip-label">Ans d'expérience</span>
            </div>
        </div>
        <div class="strip-divider"></div>
        <div class="strip-stat">
            <i class="fas fa-user-md"></i>
            <div>
                <span class="strip-number" data-count="12">0</span>
                <span class="strip-label">Médecins spécialistes</span>
            </div>
        </div>
        <div class="strip-divider"></div>
        <div class="strip-stat">
            <i class="fas fa-star"></i>
            <div>
                <span class="strip-number" data-count="98">0</span><span>%</span>
                <span class="strip-label">Satisfaction patients</span>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Page-specific: hero typing animation
    document.addEventListener('DOMContentLoaded', () => {
        generateParticles();
        initHeroPage();
        animateStripStats();
    });
</script>
@endpush
