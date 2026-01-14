# Commandes de déploiement en production

## Commandes essentielles à exécuter après chaque déploiement :

```bash
# 1. Installer les dépendances (sans les packages de développement)
composer install --optimize-autoloader --no-dev

# 2. Optimiser Laravel (cache config, routes, views)
php artisan optimize

# 3. Vérifier que le dossier Images existe et a les bonnes permissions
# (Les images sont dans public/Images/, pas besoin de storage:link)
chmod -R 755 public/Images

# 4. Vérifier les permissions des dossiers Laravel
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache  # (remplacer www-data par l'utilisateur du serveur web)
```

## Commandes individuelles (si vous préférez les exécuter séparément) :

```bash
# Mettre en cache la configuration
php artisan config:cache

# Mettre en cache les routes
php artisan route:cache

# Mettre en cache les vues
php artisan view:cache

# Créer le lien symbolique pour storage (si vous utilisez storage/app/public)
php artisan storage:link
```

## Vérifications importantes :

1. **Fichier .env** : Assurez-vous que `APP_ENV=production` et `APP_DEBUG=false`
2. **Dossier Images** : Vérifiez que `public/Images/` existe et contient tous les fichiers
3. **Permissions** : Les fichiers dans `public/Images/` doivent être lisibles par le serveur web
4. **APP_URL** : Vérifiez que `APP_URL` dans `.env` correspond à votre domaine

## En cas de problème avec les images :

```bash
# Vérifier que le dossier existe
ls -la public/Images/

# Vérifier les permissions
ls -la public/Images/logo.png

# Corriger les permissions si nécessaire
chmod 644 public/Images/*
chmod 755 public/Images
```
