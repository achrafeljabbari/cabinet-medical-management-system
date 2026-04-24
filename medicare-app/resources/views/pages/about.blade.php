@extends('layouts.app')
@section('title', 'À Propos')

@section('content')

<section class="page-hero-mini">
    <div class="page-hero-mini-content">
        <span class="page-breadcrumb">
            <a href="{{ route('home') }}">Accueil</a>
            <i class="fas fa-chevron-right"></i>
            <span>À Propos</span>
        </span>
        <h1 class="page-hero-title">
            <i class="fas fa-hospital-alt"></i>
            À Propos de Medicare
        </h1>
        <p class="page-hero-subtitle">Notre histoire, nos valeurs, notre engagement envers votre santé</p>
    </div>
    <div class="page-hero-bg"></div>
</section>

<section class="section about-section">
    <div class="section-container">

        <!-- Histoire -->
        <div class="about-content">
            <div class="about-text-wrapper">
                <div class="section-header">
                    <span class="section-number">01</span>
                    <h2 class="section-title">
                        <span class="title-bracket"><i class="fas fa-hospital-alt"></i></span>
                        <span class="title-text">Notre Histoire</span>
                    </h2>
                    <div class="section-line"></div>
                </div>
                <p class="about-text">
                    Medicare est un cabinet médical moderne fondé en 2010, dédié à offrir des soins
                    de santé complets et personnalisés. Notre équipe pluridisciplinaire de médecins
                    spécialistes travaille en synergie pour garantir le meilleur suivi thérapeutique
                    à chaque patient.
                </p>
                <p class="about-text">
                    Depuis notre création, nous avons placé l'innovation médicale et la relation
                    patient-médecin au cœur de notre démarche. Nous croyons que chaque patient
                    mérite une écoute attentive et des soins adaptés à sa situation personnelle.
                </p>

                <div class="about-stats">
                    <div class="stat-item">
                        <div class="stat-number" data-count="5000">0</div>
                        <div class="stat-label">Patients Suivis</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="14">0</div>
                        <div class="stat-label">Ans d'Expérience</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="12">0</div>
                        <div class="stat-label">Médecins Spécialistes</div>
                    </div>
                </div>
            </div>

            <div class="about-image-wrapper">
                <div class="about-image-container">
                    <div class="code-block">
                        <div class="code-line">
                            <span class="code-keyword">cabinet</span>
                            <span class="code-variable"> Medicare</span>
                            <span class="code-brace"> {</span>
                        </div>
                        <div class="code-line indent">
                            <span class="code-property">fondé</span>
                            <span class="code-operator"> :</span>
                            <span class="code-string"> '2010'</span><span class="code-comma">,</span>
                        </div>
                        <div class="code-line indent">
                            <span class="code-property">ville</span>
                            <span class="code-operator"> :</span>
                            <span class="code-string"> 'Casablanca'</span><span class="code-comma">,</span>
                        </div>
                        <div class="code-line indent">
                            <span class="code-property">spécialités</span>
                            <span class="code-operator"> :</span>
                            <span class="code-bracket"> [</span>
                        </div>
                        <div class="code-line indent-2">
                            <span class="code-string">'Cardiologie'</span><span class="code-comma">,</span>
                        </div>
                        <div class="code-line indent-2">
                            <span class="code-string">'Pédiatrie'</span><span class="code-comma">,</span>
                        </div>
                        <div class="code-line indent-2">
                            <span class="code-string">'Neurologie'</span>
                        </div>
                        <div class="code-line indent">
                            <span class="code-bracket">]</span><span class="code-comma">,</span>
                        </div>
                        <div class="code-line indent">
                            <span class="code-property">urgences</span>
                            <span class="code-operator"> :</span>
                            <span class="code-string"> '24h/7j'</span>
                        </div>
                        <div class="code-line">
                            <span class="code-brace">}</span><span class="code-semicolon">;</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Valeurs -->
        <div class="values-section">
            <div class="section-header" style="margin-top:4rem">
                <span class="section-number">02</span>
                <h2 class="section-title">
                    <span class="title-bracket"><i class="fas fa-heart"></i></span>
                    <span class="title-text">Nos Valeurs</span>
                </h2>
                <div class="section-line"></div>
            </div>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-hand-holding-heart"></i></div>
                    <h3>Compassion</h3>
                    <p>Nous traitons chaque patient avec empathie et respect, en comprenant que la maladie touche l'être dans sa globalité.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-award"></i></div>
                    <h3>Excellence</h3>
                    <p>Nous maintenons les plus hauts standards médicaux grâce à une formation continue et à l'adoption des dernières avancées.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3>Confiance</h3>
                    <p>La confidentialité et la transparence sont au cœur de chaque relation thérapeutique que nous construisons.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-users"></i></div>
                    <h3>Collaboration</h3>
                    <p>Notre approche pluridisciplinaire garantit une prise en charge globale et coordonnée de chaque patient.</p>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        animateStatsOnScroll();
        animateCardsOnScroll();
    });
</script>
@endpush
