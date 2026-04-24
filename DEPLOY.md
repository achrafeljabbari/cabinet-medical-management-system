# Guide de Déploiement — Medicare sur Railway

## 1. Pourquoi l'erreur 500 et l'échec du build ?

1.  **Conflit de noms de routes** : L'erreur `notifications.index` arrivait car les routes API et Web utilisaient les mêmes noms. J'ai préfixé toutes les routes API par `api.` (ex: `api.notifications.index`).
2.  **APP_KEY manquante** : L'erreur 500 sur le site live est presque toujours due à l'absence de la variable `APP_KEY` dans l'interface de Railway.

## 2. Actions à faire pour corriger (CÔTÉ RAILWAY)

Allez dans votre projet sur Railway, onglet **Variables**, et ajoutez/vérifiez :

- **`APP_KEY`** : (Obligatoire) Exécutez `php artisan key:generate --show` localement et copiez la valeur (ex: `base64:xxxx...`).
- **`APP_DEBUG`** : Mettez à `true` temporairement pour voir l'erreur exacte au lieu de "500 Server Error", puis remettez à `false` une fois corrigé.
- **`DB_CONNECTION`** : `mysql`
- **`DATABASE_URL`** : Railway l'injecte souvent tout seul si vous avez lié un service MySQL. Sinon, utilisez les variables `MYSQLHOST`, `MYSQLUSER`, etc.
- **`FORCE_HTTPS`** : Mettez à `true` dans les variables Railway pour garantir que tous les liens (CSS/JS) utilisent HTTPS.

## 3. Sécurisation des Assets (HTTPS)

Pour garantir que le frontend (CSS/JS) fonctionne sans erreur de "Mixed Content" :
1.  **Forçage HTTPS** : J'ai ajouté une règle dans `AppServiceProvider.php` qui force tous les liens à utiliser `https://` quand l'application est en production.
2.  **Configuration Vite** : Le build génère les assets correctement, et Laravel les servira via HTTPS grâce à la règle ci-dessus.

## 4. Étapes pour redéployer

1.  **Commit et Push** :
    ```bash
    git add .
    git commit -m "Fix: route naming conflict and update Dockerfile"
    git push origin main
    ```
2.  **Surveillance** : Regardez les **Build Logs** sur Railway. Le build devrait passer maintenant car j'ai assoupli le Dockerfile.
3.  **Logs de déploiement** : Si le site affiche toujours 500, allez dans l'onglet **Logs** (Deploy Logs) sur Railway. Vous verrez l'erreur PHP exacte (ex: "Database connection refused" ou "Permission denied").

## 4. Corrections effectuées dans le code

-   **Routes API** : Toutes les routes dans `api.php` sont maintenant nommées `api.xxx` pour éviter les collisions avec `web.php`.
-   **Dockerfile** : Suppression temporaire de `route:cache` pour garantir que le build se termine. L'optimisation pourra être remise plus tard.
-   **AuthController** : Suppression des closures pour compatibilité avec le cache Laravel.

---
*Si vous voyez toujours une erreur 500, vérifiez bien que votre base de données MySQL sur Railway est active et que l'utilisateur a les droits.*
