@extends('layouts.app')
@section('title', 'Nos Services')

@section('content')

<section class="page-hero-mini">
    <div class="page-hero-mini-content">
        <span class="page-breadcrumb">
            <a href="{{ route('home') }}">Accueil</a>
            <i class="fas fa-chevron-right"></i>
            <span>Services</span>
        </span>
        <h1 class="page-hero-title">
            <i class="fas fa-stethoscope"></i>
            Nos Services Médicaux
        </h1>
        <p class="page-hero-subtitle">Des soins complets et des technologies de pointe à votre service</p>
    </div>
    <div class="page-hero-bg"></div>
</section>

<section class="section skills-section">
    <div class="section-container">

        <div class="section-header">
            <span class="section-number">01</span>
            <h2 class="section-title">
                <span class="title-bracket"><i class="fas fa-stethoscope"></i></span>
                <span class="title-text">Consultations</span>
            </h2>
            <div class="section-line"></div>
        </div>

        <div class="skills-grid">
            <div class="skill-category">
                <h3 class="category-title">Consultations</h3>
                <div class="skill-items">
                    <div class="skill-item" data-percent="98">
                        <div class="skill-header">
                            <span class="skill-name"><i class="fas fa-user-md"></i> Médecine Générale</span>
                            <span class="skill-percent">0%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress"></div></div>
                    </div>
                    <div class="skill-item" data-percent="92">
                        <div class="skill-header">
                            <span class="skill-name"><i class="fas fa-heartbeat"></i> Cardiologie</span>
                            <span class="skill-percent">0%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress"></div></div>
                    </div>
                    <div class="skill-item" data-percent="95">
                        <div class="skill-header">
                            <span class="skill-name"><i class="fas fa-baby"></i> Pédiatrie</span>
                            <span class="skill-percent">0%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress"></div></div>
                    </div>
                    <div class="skill-item" data-percent="88">
                        <div class="skill-header">
                            <span class="skill-name"><i class="fas fa-brain"></i> Neurologie</span>
                            <span class="skill-percent">0%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress"></div></div>
                    </div>
                </div>
            </div>

            <div class="skill-category">
                <h3 class="category-title">Examens & Diagnostics</h3>
                <div class="skill-items">
                    <div class="skill-item" data-percent="90">
                        <div class="skill-header">
                            <span class="skill-name"><i class="fas fa-wave-square"></i> Échographie</span>
                            <span class="skill-percent">0%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress"></div></div>
                    </div>
                    <div class="skill-item" data-percent="85">
                        <div class="skill-header">
                            <span class="skill-name"><i class="fas fa-x-ray"></i> Radiologie</span>
                            <span class="skill-percent">0%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress"></div></div>
                    </div>
                    <div class="skill-item" data-percent="97">
                        <div class="skill-header">
                            <span class="skill-name"><i class="fas fa-flask"></i> Analyses Biologiques</span>
                            <span class="skill-percent">0%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress"></div></div>
                    </div>
                    <div class="skill-item" data-percent="93">
                        <div class="skill-header">
                            <span class="skill-name"><i class="fas fa-heart"></i> ECG / Holter</span>
                            <span class="skill-percent">0%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress"></div></div>
                    </div>
                </div>
            </div>

            <div class="skill-category">
                <h3 class="category-title">Services Additionnels</h3>
                <div class="skill-items">
                    <div class="skill-item" data-percent="100">
                        <div class="skill-header">
                            <span class="skill-name"><i class="fas fa-ambulance"></i> Urgences 24h/7j</span>
                            <span class="skill-percent">0%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress"></div></div>
                    </div>
                    <div class="skill-item" data-percent="80">
                        <div class="skill-header">
                            <span class="skill-name"><i class="fas fa-video"></i> Téléconsultation</span>
                            <span class="skill-percent">0%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress"></div></div>
                    </div>
                    <div class="skill-item" data-percent="95">
                        <div class="skill-header">
                            <span class="skill-name"><i class="fas fa-syringe"></i> Vaccination</span>
                            <span class="skill-percent">0%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress"></div></div>
                    </div>
                    <div class="skill-item" data-percent="78">
                        <div class="skill-header">
                            <span class="skill-name"><i class="fas fa-apple-alt"></i> Nutrition & Diététique</span>
                            <span class="skill-percent">0%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarifs Section -->
        <div class="section-header" style="margin-top:5rem">
            <span class="section-number">02</span>
            <h2 class="section-title">
                <span class="title-bracket"><i class="fas fa-tags"></i></span>
                <span class="title-text">Nos Tarifs</span>
            </h2>
            <div class="section-line"></div>
        </div>

        <div class="tarifs-grid">
            <div class="tarif-card">
                <div class="tarif-icon"><i class="fas fa-user-md"></i></div>
                <h3>Consultation Générale</h3>
                <div class="tarif-price">150 <span>MAD</span></div>
                <ul class="tarif-features">
                    <li><i class="fas fa-check"></i> Examen clinique complet</li>
                    <li><i class="fas fa-check"></i> Ordonnance médicale</li>
                    <li><i class="fas fa-check"></i> Suivi personnalisé</li>
                </ul>
                <a href="{{ route('contact') }}" class="btn btn-primary">Prendre RDV</a>
            </div>
            <div class="tarif-card tarif-featured">
                <div class="tarif-badge">Recommandé</div>
                <div class="tarif-icon"><i class="fas fa-heartbeat"></i></div>
                <h3>Bilan Complet</h3>
                <div class="tarif-price">450 <span>MAD</span></div>
                <ul class="tarif-features">
                    <li><i class="fas fa-check"></i> Consultation + ECG</li>
                    <li><i class="fas fa-check"></i> Analyses biologiques</li>
                    <li><i class="fas fa-check"></i> Écho-doppler</li>
                    <li><i class="fas fa-check"></i> Rapport détaillé</li>
                </ul>
                <a href="{{ route('contact') }}" class="btn btn-primary">Prendre RDV</a>
            </div>
            <div class="tarif-card">
                <div class="tarif-icon"><i class="fas fa-video"></i></div>
                <h3>Téléconsultation</h3>
                <div class="tarif-price">100 <span>MAD</span></div>
                <ul class="tarif-features">
                    <li><i class="fas fa-check"></i> Consultation en ligne</li>
                    <li><i class="fas fa-check"></i> Ordonnance électronique</li>
                    <li><i class="fas fa-check"></i> Suivi par messagerie</li>
                </ul>
                <a href="{{ route('contact') }}" class="btn btn-primary">Prendre RDV</a>
            </div>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        initSkillAnimations('body');
        animateCardsOnScroll();
    });
</script>
@endpush
