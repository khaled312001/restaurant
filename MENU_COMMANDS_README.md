# 🍽️ Commandes de Menu - King Kebab

Ce document décrit les commandes Artisan créées pour récupérer et afficher les données du menu du restaurant King Kebab depuis la base de données MySQL.

## 📋 Commandes Disponibles

### 1. `menu:sections` - Afficher les Sections du Menu
Affiche toutes les sections du menu avec le nombre de plats disponibles dans chaque section.

**Usage:**
```bash
php artisan menu:sections
```

**Options:**
- `--detailed` : Affiche également la liste détaillée des produits avec leurs prix

**Exemple:**
```bash
# Affichage simple des sections
php artisan menu:sections

# Affichage détaillé avec produits et prix
php artisan menu:sections --detailed
```

### 2. `menu:show-french` - Menu Complet en Français
Affiche le menu complet en français avec toutes les sections, repas et leurs prix.

**Usage:**
```bash
php artisan menu:show-french
```

### 3. `menu:fetch-data` - Récupération de Données
Récupère les données du menu depuis la base de données MySQL avec différents formats de sortie.

**Usage:**
```bash
php artisan menu:fetch-data [options]
```

**Options:**
- `--lang=fr` : Code de langue (défaut: fr)
- `--format=table` : Format de sortie (table, json, csv)

**Exemples:**
```bash
# Format tableau (défaut)
php artisan menu:fetch-data

# Format JSON
php artisan menu:fetch-data --format=json

# Format CSV
php artisan menu:fetch-data --format=csv

# Langue différente
php artisan menu:fetch-data --lang=en --format=json
```

## 🗂️ Sections du Menu Disponibles

Le menu contient les sections suivantes :

1. **Sandwichs** - 23 plats disponibles
2. **Menus** - 16 plats disponibles  
3. **Assiettes** - 16 plats disponibles
4. **Menus Enfant** - 5 plats disponibles
5. **Tacos** - 9 plats disponibles
6. **Burger** - 6 plats disponibles
7. **Salade** - 4 plats disponibles
8. **Nos Box** - 0 plats disponibles

## 💰 Exemples de Prix

### Sandwichs
- **AMERICAIN** - 7.50 €
- **Cheese Burger** - 5.50 €
- **KEBAB** - 7.00 €
- **MAXI KEBAB** - 12.00 €

### Menus
- **Menu Kebab** - 11.00 €
- **Menu Tacos** - 11.50 €
- **Menu Maxi Tacos 999g** - 16.00 €

### Assiettes
- **Assiette Kebab** - 13.00 €
- **Assiette KOBANE** - 15.00 €
- **KING** - 14.00 €

### Tacos
- **TACOS (1 VIANDE)** - 8.00 €
- **TACOS MIXTE (2 VIANDES)** - 9.50 €
- **MEGA TACOS** - 12.50 €

## 🔧 Configuration

Les commandes se connectent automatiquement à la base de données configurée dans le fichier `.env` de Laravel.

**Variables d'environnement requises:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=king_kebab
DB_USERNAME=root
DB_PASSWORD=
```

## 📊 Formats de Sortie

### Format Tableau
Affichage structuré dans le terminal avec des tableaux formatés.

### Format JSON
Données structurées en JSON pour traitement programmatique.

### Format CSV
Données au format CSV pour export vers Excel ou autres outils.

## 🚀 Utilisation Avancée

### Intégration dans d'autres scripts
```php
// Exécuter une commande depuis du code PHP
Artisan::call('menu:fetch-data', [
    '--format' => 'json',
    '--lang' => 'fr'
]);
```

### Planification avec Cron
```bash
# Ajouter dans crontab pour mise à jour quotidienne
0 6 * * * cd /path/to/king_kebab && php artisan menu:fetch-data --format=csv > /tmp/menu_$(date +\%Y\%m\%d).csv
```

## 📝 Notes Techniques

- Les commandes récupèrent uniquement les produits actifs (`status = 1`)
- Le tri se fait par nom de catégorie puis par nom de produit
- Les prix sont affichés en euros (€)
- Les produits spéciaux sont marqués avec ⭐
- Les prix barrés (anciens prix) sont affichés quand disponibles

## 🐛 Dépannage

### Erreur de connexion à la base de données
- Vérifier la configuration dans `.env`
- S'assurer que MySQL est démarré
- Vérifier les permissions de l'utilisateur de base de données

### Aucun produit affiché
- Vérifier que la langue française est configurée
- S'assurer que les produits ont le statut actif
- Vérifier les relations entre catégories et produits

## 📞 Support

Pour toute question ou problème avec ces commandes, consulter la documentation Laravel ou contacter l'équipe de développement. 