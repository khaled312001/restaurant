# Correction du Téléchargeur d'Images - King Kebab Restaurant

## Problème Identifié

Le script `google_image_downloader.php` rencontrait des erreurs lors du téléchargement des images depuis les services d'images (Unsplash, Pexels, Pixabay). Les erreurs principales étaient :

- Échecs de téléchargement avec `file_get_contents()`
- Gestion insuffisante des erreurs HTTP
- Pas de vérification du type MIME des images
- Pas de système de retry en cas d'échec

## Corrections Apportées

### 1. Remplacement de `file_get_contents()` par cURL

- **Avant** : Utilisation de `file_get_contents()` qui peut échouer silencieusement
- **Après** : Utilisation de cURL avec gestion complète des erreurs

### 2. Amélioration de la Gestion des Erreurs

- Vérification des codes HTTP
- Gestion des erreurs cURL
- Vérification du type MIME des images
- Logs détaillés des erreurs

### 3. Système de Retry Amélioré

- Retry automatique avec requêtes simplifiées
- Délais configurables entre les tentatives
- Limitation du nombre de retry

### 4. Configuration Optimisée

- Timeout augmenté à 60 secondes
- User-Agent mis à jour
- Délais entre requêtes configurables

## Fichiers Modifiés

- `google_image_downloader.php` - Script principal corrigé
- `test_image_downloader.php` - Script de test des corrections
- `fix_missing_images.php` - Script de correction rapide

## Comment Utiliser

### 1. Test des Corrections

```bash
php test_image_downloader.php
```

Ce script teste :
- Disponibilité de cURL
- Création des répertoires
- Recherche d'images
- Téléchargement d'images

### 2. Correction des Images Manquantes

```bash
php fix_missing_images.php
```

Ce script :
- Identifie les repas sans images
- Tente de télécharger de nouvelles images
- Met à jour la base de données
- Fournit un résumé des corrections

### 3. Téléchargement Complet

```bash
php google_image_downloader.php
```

**⚠️ Attention** : Ce script télécharge des images pour TOUS les repas. Utilisez-le avec précaution.

## Prérequis

- PHP avec extension cURL activée
- Accès à la base de données MySQL
- Permissions d'écriture dans les répertoires d'images

## Configuration

Modifiez la configuration dans `google_image_downloader.php` selon vos besoins :

```php
$config = [
    'database' => [
        'host' => 'localhost',
        'database' => 'superv',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8mb4'
    ],
    // ... autres paramètres
];
```

## Dépannage

### Erreur "cURL extension is required"

Installez l'extension cURL pour PHP :
```bash
# Ubuntu/Debian
sudo apt-get install php-curl

# Windows avec XAMPP
# Vérifiez que extension=curl est décommenté dans php.ini
```

### Erreurs de Permissions

Vérifiez les permissions des répertoires :
```bash
chmod 755 public/assets/front/img/product/featured/
chmod 755 public/assets/front/img/product/backup/
chmod 755 logs/
```

### Erreurs de Base de Données

Vérifiez la connexion à la base de données et les paramètres dans la configuration.

## Logs

Les logs sont sauvegardés dans `logs/google_image_downloader.log` avec :
- Horodatage des opérations
- Niveau de log (INFO, WARNING, ERROR)
- Détails des erreurs
- Résumé des opérations

## Support

En cas de problème :
1. Vérifiez les logs dans `logs/google_image_downloader.log`
2. Testez avec `test_image_downloader.php`
3. Vérifiez la configuration de la base de données
4. Assurez-vous que cURL est disponible

## Notes de Sécurité

- Le script désactive la vérification SSL pour éviter les erreurs de certificats
- Utilisez des clés API officielles pour de meilleurs résultats
- Respectez les limites de taux des services d'images
- Sauvegardez votre base de données avant d'exécuter le script
