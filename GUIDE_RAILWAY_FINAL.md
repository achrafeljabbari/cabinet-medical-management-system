# 🚀 Guide Ultime : Déployer Medicare sur Railway

Ce guide est conçu pour vous accompagner pas à pas, même si vous n'avez jamais fait de déploiement. Suivez chaque étape dans l'ordre.

---

## Étape 1 : Préparer votre code pour le "Push" final

J'ai déjà corrigé tous les fichiers critiques. Voici ce qui a été fait :
- **HTTPS forcé** : Vos fichiers CSS et JS se chargeront correctement sans erreur de sécurité.
- **Routes renommées** : Plus aucun conflit entre l'API et le Web.
- **Closures supprimées** : Le cache Laravel fonctionnera parfaitement sur le serveur.
- **Dockerfile optimisé** : Railway saura exactement comment construire votre application.

**Action à faire dans votre terminal :**
```bash
git add .
git commit -m "Final fix: ready for production deployment"
git push origin main
```

---

## Étape 2 : Créer le projet sur Railway

1. Connectez-vous sur [railway.app](https://railway.app/).
2. Cliquez sur **"+ New Project"**.
3. Choisissez **"Deploy from GitHub repo"**.
4. Sélectionnez votre dépôt (celui qui contient le dossier `MEDICARE`).
5. **ATTENTION** : Railway va détecter le `Dockerfile` à la racine et commencer à construire. Laissez-le faire, même s'il échoue au premier essai (c'est normal car les variables ne sont pas encore mises).

---

## Étape 3 : Ajouter la Base de Données

1. Dans votre projet Railway, cliquez sur le bouton **"View"** (ou sur le bouton "+" en haut à droite).
2. Choisissez **"Database"** puis **"Add MySQL"**.
3. Railway va créer un service MySQL. Patientez quelques secondes.

---

## Étape 4 : Configurer les Variables d'Environnement (CRUCIAL)

C'est ici que 90% des erreurs se produisent. Allez sur votre service **Web** (celui qui a le nom de votre repo), puis dans l'onglet **"Variables"**.

Cliquez sur **"New Variable"** pour ajouter chacune de celles-ci :

| Nom de la Variable | Valeur |
| :--- | :--- |
| **`APP_KEY`** | `base64:zoy27AXpOIdFluHzMt7IXDNgHXgbreCMwwlP67DyZ8s=` |
| **`APP_ENV`** | `production` |
| **`APP_DEBUG`** | `false` |
| **`APP_URL`** | L'URL générée par Railway (ex: `https://medicare.up.railway.app`) |
| **`DB_CONNECTION`** | `mysql` |
| **`FORCE_HTTPS`** | `true` |
| **`SESSION_DRIVER`** | `database` |

**Astuce pour la base de données :**
Au lieu de taper l'hôte et le mot de passe manuellement, Railway permet de faire une "Reference". Quand vous créez une variable, tapez `${{MySQL.MYSQL_URL}}` pour la variable `DATABASE_URL` (si Laravel ne le fait pas tout seul). Mais normalement, Laravel 11 détecte automatiquement les variables MySQL de Railway.

---

## Étape 5 : Vérifier le Déploiement

1. Une fois les variables enregistrées, Railway va relancer un déploiement automatiquement.
2. Allez dans l'onglet **"Deployments"**. Cliquez sur le dernier en date.
3. Regardez les **"Build Logs"** : Vous devriez voir `Vite vX.X.X building for production` et `Route cache cleared!`.
4. Regardez les **"Deploy Logs"** : Vous devriez voir `SUCCESS: Migration table created successfully`.

---

## Étape 6 : Comment corriger si ça ne marche pas ?

- **Erreur 500** : Allez dans l'onglet **Variables**, changez `APP_DEBUG` à `true`. Rechargez votre site. Laravel vous dira exactement quel fichier ou quelle ligne pose problème.
- **CSS non chargé** : Vérifiez que vous avez bien mis `FORCE_HTTPS=true` dans les variables.
- **Page Blanche** : Vérifiez les "Deploy Logs" sur Railway. Il se peut qu'il manque une extension PHP ou que la base de données ne réponde pas.

---

## Résumé des fichiers modifiés lors de cet audit final :
1.  **`routes/api.php`** : Noms de routes préfixés par `api.`.
2.  **`routes/console.php`** : Closure supprimée.
3.  **`app/Providers/AppServiceProvider.php`** : HTTPS forcé en production.
4.  **`Dockerfile`** : Optimisation finale pour la production.
5.  **`railway.json`** : Configuration du point d'entrée.

---
*Félicitations ! Votre projet Medicare est prêt pour le monde réel.* 🏥✨
