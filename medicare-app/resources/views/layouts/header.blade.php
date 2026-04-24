<header class="main-header" id="header">
    <nav class="nav-container">

        <!-- Brand -->
        <a href="{{ route('home') }}" class="nav-brand">
            <div class="brand-logo">
                <span class="logo-cross"><i class="fas fa-plus"></i></span>
                <span class="logo-text">Medicare</span>
            </div>
        </a>

        <!-- Nav Menu -->
        <div class="nav-menu" id="navMenu">
            <a href="{{ route('home') }}"
               class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
               data-section="home">
                <i class="fas fa-home"></i>
                <span class="nav-text">Accueil</span>
            </a>
            <a href="{{ route('about') }}"
               class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
               data-section="about">
                <i class="fas fa-hospital"></i>
                <span class="nav-text">À Propos</span>
            </a>
            <a href="{{ route('services') }}"
               class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}"
               data-section="services">
                <i class="fas fa-stethoscope"></i>
                <span class="nav-text">Services</span>
            </a>
            <a href="{{ route('equipe') }}"
               class="nav-link {{ request()->routeIs('equipe') ? 'active' : '' }}"
               data-section="equipe">
                <i class="fas fa-user-md"></i>
                <span class="nav-text">Équipe</span>
            </a>
            <a href="{{ route('temoignages') }}"
               class="nav-link {{ request()->routeIs('temoignages') ? 'active' : '' }}"
               data-section="temoignages">
                <i class="fas fa-comments"></i>
                <span class="nav-text">Témoignages</span>
            </a>
            <a href="{{ route('contact') }}"
               class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
               data-section="contact">
                <i class="fas fa-calendar-check"></i>
                <span class="nav-text">Rendez-vous</span>
            </a>
        </div>

        <!-- Auth Buttons + Mobile Toggle -->
        <div class="nav-controls">
            @auth
                {{-- Utilisateur connecté --}}
                <div class="nav-user-menu">
                    <button class="btn-user-avatar" id="userMenuToggle">
                        <i class="fas fa-user-circle"></i>
                        <span>{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down fa-xs"></i>
                    </button>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="{{ route('dashboard') }}" class="dropdown-item">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <a href="{{ route('profile') }}" class="dropdown-item">
                            <i class="fas fa-user-edit"></i> Mon Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item dropdown-logout">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            @else
                {{-- Visiteur --}}
                <a href="{{ route('login') }}" class="btn-auth btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Connexion</span>
                </a>
                <a href="{{ route('register') }}" class="btn-auth btn-register">
                    <i class="fas fa-user-plus"></i>
                    <span>Inscription</span>
                </a>
            @endauth

            <!-- Mobile Toggle -->
            <button class="menu-toggle" id="menuToggle" title="Menu" aria-label="Ouvrir le menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>
</header>
