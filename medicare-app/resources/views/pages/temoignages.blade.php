@extends('layouts.app')
@section('title', 'Témoignages')

@section('content')

<section class="page-hero-mini">
    <div class="page-hero-mini-content">
        <span class="page-breadcrumb">
            <a href="{{ route('home') }}">Accueil</a>
            <i class="fas fa-chevron-right"></i>
            <span>Témoignages</span>
        </span>
        <h1 class="page-hero-title">
            <i class="fas fa-comments"></i>
            Témoignages Patients
        </h1>
        <p class="page-hero-subtitle">Ce que nos patients disent de nous</p>
    </div>
    <div class="page-hero-bg"></div>
</section>

<section class="section projects-section">
    <div class="section-container">

        <div class="section-header">
            <span class="section-number">01</span>
            <h2 class="section-title">
                <span class="title-bracket"><i class="fas fa-star"></i></span>
                <span class="title-text">Avis & Témoignages</span>
            </h2>
            <div class="section-line"></div>
        </div>

        <!-- Note globale -->
        <div class="global-rating">
            <div class="rating-number">4.9</div>
            <div class="rating-stars">
                <i class="fas fa-star"></i><i class="fas fa-star"></i>
                <i class="fas fa-star"></i><i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <div class="rating-total">Basé sur 247 avis vérifiés</div>
        </div>

        <div class="projects-grid">
            <div class="project-card">
                <div class="project-image testi-bg">
                    <div class="project-overlay">
                        <span class="star-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i>
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </span>
                    </div>
                    <div class="project-placeholder testi-placeholder">
                        <i class="fas fa-quote-left"></i>
                    </div>
                </div>
                <div class="project-content">
                    <h3 class="project-title">Aïcha M. — 47 ans</h3>
                    <p class="project-description">
                        Suivi exceptionnel pour mon problème cardiaque. Le Dr. Benali est très à l'écoute
                        et explique chaque étape du traitement. L'accueil au cabinet est chaleureux et professionnel.
                    </p>
                    <div class="project-tags">
                        <span class="tag"><i class="fas fa-heartbeat"></i> Cardiologie</span>
                        <span class="tag">Patient fidèle</span>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <div class="project-image testi-bg">
                    <div class="project-overlay">
                        <span class="star-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i>
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </span>
                    </div>
                    <div class="project-placeholder testi-placeholder">
                        <i class="fas fa-quote-left"></i>
                    </div>
                </div>
                <div class="project-content">
                    <h3 class="project-title">Youssef K. — 34 ans</h3>
                    <p class="project-description">
                        Ma fille est suivie depuis sa naissance par la Dr. Cherkaoui. Son professionnalisme
                        et sa douceur avec les enfants nous rassurent énormément. Cabinet moderne et très propre.
                    </p>
                    <div class="project-tags">
                        <span class="tag"><i class="fas fa-baby"></i> Pédiatrie</span>
                        <span class="tag">Depuis 3 ans</span>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <div class="project-image testi-bg">
                    <div class="project-overlay">
                        <span class="star-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i>
                            <i class="fas fa-star"></i><i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                    </div>
                    <div class="project-placeholder testi-placeholder">
                        <i class="fas fa-quote-left"></i>
                    </div>
                </div>
                <div class="project-content">
                    <h3 class="project-title">Fatima Z. — 62 ans</h3>
                    <p class="project-description">
                        Le Dr. Fassi a su diagnostiquer mes migraines chroniques après des années de souffrance.
                        Grâce à Medicare, j'ai retrouvé une qualité de vie que je croyais perdue.
                    </p>
                    <div class="project-tags">
                        <span class="tag"><i class="fas fa-brain"></i> Neurologie</span>
                        <span class="tag">Migraines</span>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <div class="project-image testi-bg">
                    <div class="project-overlay">
                        <span class="star-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i>
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </span>
                    </div>
                    <div class="project-placeholder testi-placeholder">
                        <i class="fas fa-quote-left"></i>
                    </div>
                </div>
                <div class="project-content">
                    <h3 class="project-title">Mehdi A. — 29 ans</h3>
                    <p class="project-description">
                        La téléconsultation est une révolution pour moi. Je peux consulter depuis mon bureau
                        et recevoir mon ordonnance en quelques minutes. Très pratique et efficace.
                    </p>
                    <div class="project-tags">
                        <span class="tag"><i class="fas fa-video"></i> Téléconsultation</span>
                        <span class="tag">Patient récent</span>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <div class="project-image testi-bg">
                    <div class="project-overlay">
                        <span class="star-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i>
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </span>
                    </div>
                    <div class="project-placeholder testi-placeholder">
                        <i class="fas fa-quote-left"></i>
                    </div>
                </div>
                <div class="project-content">
                    <h3 class="project-title">Nadia B. — 51 ans</h3>
                    <p class="project-description">
                        Bilan complet réalisé en une journée. Personnel accueillant, résultats rapides.
                        Je recommande vivement Medicare à toute ma famille.
                    </p>
                    <div class="project-tags">
                        <span class="tag"><i class="fas fa-flask"></i> Bilan complet</span>
                        <span class="tag">Recommandé</span>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <div class="project-image testi-bg">
                    <div class="project-overlay">
                        <span class="star-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i>
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </span>
                    </div>
                    <div class="project-placeholder testi-placeholder">
                        <i class="fas fa-quote-left"></i>
                    </div>
                </div>
                <div class="project-content">
                    <h3 class="project-title">Hassan L. — 38 ans</h3>
                    <p class="project-description">
                        Service d'urgences très réactif. Prise en charge immédiate à 2h du matin.
                        Équipe compétente et rassurante dans des moments difficiles.
                    </p>
                    <div class="project-tags">
                        <span class="tag"><i class="fas fa-ambulance"></i> Urgences</span>
                        <span class="tag">Prise en charge rapide</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => { animateCardsOnScroll(); });
</script>
@endpush
