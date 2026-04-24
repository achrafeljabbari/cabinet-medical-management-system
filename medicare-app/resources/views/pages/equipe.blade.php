@extends('layouts.app')
@section('title', 'Notre Équipe')

@section('content')

<section class="page-hero-mini">
    <div class="page-hero-mini-content">
        <span class="page-breadcrumb">
            <a href="{{ route('home') }}">Accueil</a>
            <i class="fas fa-chevron-right"></i>
            <span>Équipe</span>
        </span>
        <h1 class="page-hero-title">
            <i class="fas fa-user-md"></i>
            Notre Équipe Médicale
        </h1>
        <p class="page-hero-subtitle">Des médecins passionnés, dévoués à votre santé</p>
    </div>
    <div class="page-hero-bg"></div>
</section>

<section class="section experience-section">
    <div class="section-container">

        <div class="section-header">
            <span class="section-number">01</span>
            <h2 class="section-title">
                <span class="title-bracket"><i class="fas fa-user-md"></i></span>
                <span class="title-text">Nos Médecins</span>
            </h2>
            <div class="section-line"></div>
        </div>

        <div class="timeline">

            <div class="timeline-item">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <div class="timeline-year">Depuis 2010</div>
                        <div class="timeline-badge">Directeur Médical</div>
                    </div>
                    <h3 class="timeline-title">Dr. Karim Benali</h3>
                    <div class="timeline-company">
                        <i class="fas fa-heartbeat"></i>
                        Cardiologue — CHU Casablanca & Medicare
                    </div>
                    <p class="timeline-description">
                        Cardiologue interventionnel avec plus de 20 ans d'expérience. Spécialiste des maladies
                        cardiovasculaires, insuffisance cardiaque et rythmologie. Formé à Paris et certifié
                        par la Société Européenne de Cardiologie.
                    </p>
                    <div class="timeline-achievements">
                        <div class="achievement-item">
                            <i class="fas fa-check-circle"></i>
                            <span>+ 2000 interventions réussies</span>
                        </div>
                        <div class="achievement-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Membre SFC & ESC</span>
                        </div>
                        <div class="achievement-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Auteur de 15 publications médicales</span>
                        </div>
                    </div>
                    <div class="timeline-tags">
                        <span class="tag">Cardiologie</span>
                        <span class="tag">ECG</span>
                        <span class="tag">Échographie</span>
                        <span class="tag">Holter</span>
                        <span class="tag">Rythmologie</span>
                    </div>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <div class="timeline-year">Depuis 2015</div>
                    </div>
                    <h3 class="timeline-title">Dr. Salma Cherkaoui</h3>
                    <div class="timeline-company">
                        <i class="fas fa-baby"></i>
                        Pédiatre — Hôpital des Enfants & Medicare
                    </div>
                    <p class="timeline-description">
                        Pédiatre spécialisée en néonatologie et maladies infantiles. Passionnée par le suivi
                        du développement de l'enfant et la vaccination. Praticienne reconnue pour son
                        approche douce et rassurante.
                    </p>
                    <div class="timeline-achievements">
                        <div class="achievement-item">
                            <i class="fas fa-check-circle"></i>
                            <span>+ 3000 enfants suivis régulièrement</span>
                        </div>
                        <div class="achievement-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Référente vaccination Maroc</span>
                        </div>
                    </div>
                    <div class="timeline-tags">
                        <span class="tag">Pédiatrie</span>
                        <span class="tag">Néonatologie</span>
                        <span class="tag">Vaccination</span>
                        <span class="tag">Nutrition Infantile</span>
                    </div>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <div class="timeline-year">Depuis 2018</div>
                    </div>
                    <h3 class="timeline-title">Dr. Omar Fassi</h3>
                    <div class="timeline-company">
                        <i class="fas fa-brain"></i>
                        Neurologue — Clinique des Spécialités & Medicare
                    </div>
                    <p class="timeline-description">
                        Neurologue clinicien spécialisé en épilepsie, migraines et maladies neurodégénératives.
                        Expert en neurophysiologie clinique et électroencéphalographie.
                        Formé à Montpellier et Barcelone.
                    </p>
                    <div class="timeline-achievements">
                        <div class="achievement-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Expert en EEG et EMG</span>
                        </div>
                        <div class="achievement-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Chercheur associé Université de Rabat</span>
                        </div>
                    </div>
                    <div class="timeline-tags">
                        <span class="tag">Neurologie</span>
                        <span class="tag">EEG</span>
                        <span class="tag">EMG</span>
                        <span class="tag">Épilepsie</span>
                        <span class="tag">Migraines</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        initTimelineAnimations();
    });
</script>
@endpush
