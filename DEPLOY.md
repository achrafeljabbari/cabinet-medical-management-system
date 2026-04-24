# Guide de Déploiement — Medicare sur Railway

Ce document détaille les étapes pour déployer l'application Medicare (Laravel + Vite) sur Railway.

## 1. Prérequis sur Railway

1. **Compte Railway** : Connectez votre compte GitHub.
2. **Base de données MySQL** : 
   - Créez un service MySQL sur Railway.
   - Railway injectera automatiquement les variables `MYSQL_URL` ou `DATABASE_URL`. Laravel utilisera `DB_URL` pour se connecter.
3. **Variables d'environnement** :
   Configurez les variables suivantes dans l'onglet **Variables** de votre service Web :
   - `APP_KEY` : Générée via `php artisan key:generate --show` (obligatoire).
   - `APP_ENV` : `production`
   - `APP_DEBUG` : `false`
   - `APP_URL` : L'URL fournie par Railway (ex: `https://medicare-production.up.railway.app`).
   - `SESSION_DRIVER` : `database`
   - `DB_CONNECTION` : `mysql`
   - `SESSION_SECURE_COOKIE` : `true`

## 2. Audit et Corrections Apportées

Avant le déploiement, les corrections suivantes ont été effectuées :
- **Suppression des Closures dans les routes** : La route `/api/user` utilisait une closure, ce qui bloquait `php artisan route:cache`. Elle a été déplacée dans `AuthController@user`.
- **Nettoyage de `env()`** : Vérification qu'aucune fonction `env()` n'est utilisée en dehors des fichiers de configuration.
- **Optimisation du Dockerfile** : 
  - Ajout du build des assets (Vite) lors de la construction de l'image.
  - Activation du cache des routes et des vues.
  - Installation automatique de Node.js et Composer.
- **Mise à jour de `.env.example`** : Ajout des variables nécessaires pour la production.

## 3. Commandes de Déploiement

### Option A : Déploiement via GitHub (Recommandé)
1. Commitez les changements :
   ```bash
   git add .
   git commit -m "Fix: preparation pour le déploiement Railway"
   git push origin main
   ```
2. Railway détectera le `Dockerfile` à la racine et lancera le build automatiquement.

### Option B : Railway CLI
```bash
railway up
```

## 4. Vérifications Post-Déploiement

1. **Migrations** : La commande `php artisan migrate --force` est exécutée automatiquement au démarrage du container.
2. **Logs** : Consultez l'onglet **Logs** sur Railway pour vérifier qu'il n'y a pas d'erreurs 500 au démarrage.
3. **Health Check** : L'application expose un endpoint `/up` pour que Railway vérifie la santé du service.

## 5. Solutions aux Erreurs Courantes

- **Erreur 500 (Missing APP_KEY)** : Assurez-vous d'avoir copié la clé `APP_KEY` dans les variables Railway.
- **Vite Manifest Not Found** : Le Dockerfile exécute `npm run build`, ce qui génère le manifest dans `public/build`. Si l'erreur persiste, vérifiez que `public/build` n'est pas écrasé par un volume.
- **Database Connection Failed** : Vérifiez que le service MySQL est bien lié (Reference) au service Web ou que `DATABASE_URL` est correctement injecté.
- **Mixed Content (HTTPS)** : Laravel détecte automatiquement le proxy de Railway, mais si les assets se chargent en HTTP, ajoutez `FORCE_HTTPS=true` aux variables d'environnement.

---
*Préparé par Gemini CLI - Avril 2026*
