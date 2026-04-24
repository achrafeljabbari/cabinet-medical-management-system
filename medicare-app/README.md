# Medicare — Cabinet Médical Laravel

## Structure du projet

```
medicare-laravel/
├── app/Http/Controllers/
│   └── PageController.php
│
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php           ← Layout principal
│   │   ├── header.blade.php        ← Header PARTAGÉ (un seul fichier)
│   │   └── footer.blade.php        ← Footer partagé
│   ├── pages/
│   │   ├── home.blade.php
│   │   ├── about.blade.php
│   │   ├── services.blade.php
│   │   ├── equipe.blade.php
│   │   ├── temoignages.blade.php
│   │   └── contact.blade.php
│   └── auth/
│       ├── login.blade.php
│       └── register.blade.php
│
├── public/
│   ├── css/medicare.css
│   ├── css/auth.css
│   └── js/medicare.js
│
└── routes/web.php
```

---

## Installation dans Laravel existant

### 1. Copier les fichiers
```bash
cp -r resources/views/layouts/   VOTRE-PROJET/resources/views/
cp -r resources/views/pages/     VOTRE-PROJET/resources/views/
cp -r resources/views/auth/      VOTRE-PROJET/resources/views/
cp public/css/medicare.css       VOTRE-PROJET/public/css/
cp public/css/auth.css           VOTRE-PROJET/public/css/
cp public/js/medicare.js         VOTRE-PROJET/public/js/
cp app/Http/Controllers/PageController.php  VOTRE-PROJET/app/Http/Controllers/
```

### 2. Fusionner les routes
Copiez le contenu de `routes/web.php` dans votre fichier de routes.

### 3. Authentification Laravel
```bash
# Option A — Laravel Breeze (recommandé)
composer require laravel/breeze --dev
php artisan breeze:install blade
php artisan migrate

# Option B — Laravel UI
composer require laravel/ui
php artisan ui bootstrap --auth
php artisan migrate
```

---

## Comment le header est partagé (zéro duplication)

**app.blade.php** = squelette HTML :
```html
@include('layouts.header')   ← injecté une seule fois
@yield('content')            ← contenu unique par page
@include('layouts.footer')
```

**Chaque page** hérite simplement :
```php
@extends('layouts.app')
@section('content')
  <!-- contenu spécifique à cette page -->
@endsection
```

**Lien actif automatique** dans le header :
```php
class="{{ request()->routeIs('home') ? 'active' : '' }}"
```

---

## Boutons Login / Register

Dans `header.blade.php`, le header affiche automatiquement :
- **Visiteur** → boutons `Connexion` + `Inscription`
- **Connecté** → menu déroulant avec nom + déconnexion

```php
@auth
    <!-- menu utilisateur -->
@else
    <a href="{{ route('login') }}" class="btn-auth btn-login">Connexion</a>
    <a href="{{ route('register') }}" class="btn-auth btn-register">Inscription</a>
@endauth
```

---

## Pages Auth

Login et Register **n'héritent PAS** de `app.blade.php`.
Elles ont leur propre layout minimal (pas de nav) avec :
- Lien "Retour à l'accueil"
- Formulaire stylisé palette Medicare
- SVG décoratifs (stéthoscope, ECG)

---

## Palette de couleurs

| Variable | Valeur | Usage |
|---|---|---|
| `--primary` | `#0f8b8d` | Teal médical principal |
| `--secondary` | `#14b8a6` | Turquoise |
| `--accent` | `#38bdf8` | Sky blue |
| `--green` | `#22c55e` | Succès / checks |
| `--bg-dark` | `#f8fcfd` | Fond clair |
| `--bg-card` | `#ffffff` | Cartes blanches |
| `--border` | `#d5e9ec` | Bordures légères |
| `--text-primary` | `#14313c` | Texte sombre |
