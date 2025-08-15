# Page de Menu - King Kebab Restaurant

## Description
Cette page affiche les 6 catégories principales du menu du restaurant King Kebab. Lorsque les utilisateurs cliquent sur "Menu" depuis l'accueil, ils voient une grille de catégories. **Important** : "Sandwichs" et "Menus" ouvrent maintenant la même page unifiée contenant les 6 choix spécifiés.

## Catégories Affichées
La page affiche **uniquement** ces 6 catégories :
1. **Assiettes** - Plats complets servis dans des assiettes
2. **Sandwichs** - Sandwichs et wraps (ouvre la page unifiée)
3. **Menus** - Menus complets avec accompagnements (ouvre la page unifiée)
4. **Salade** - Salades fraîches et composées
5. **Menus Enfant** - Portions adaptées aux enfants
6. **Nos Box** - Formules à emporter

## Page Unifiée Sandwichs & Menus
Quand les utilisateurs cliquent sur "Sandwichs" ou "Menus", ils accèdent à la même page contenant :
- **Kebab et Galette** - Spécialités du restaurant
- **Americain et Kofte** - Classiques américains et turcs
- **Tacos** - Tacos 
- **Burgers** - Burgers gourmets
- **Panini** - Panini 
- **Assiettes** - Plats complets

## Implémentation Technique

### Contrôleur
```php
public function product(Request $request)
{
    // ... (détection de langue) ...
    
    // Filtrer uniquement les 6 catégories spécifiques du menu
    $data['categories'] = Pcategory::where('status', 1)
        ->where('language_id', $currentLang->id)
        ->whereIn('name', ['Assiettes', 'Sandwichs', 'Menus', 'Salade', 'Menus Enfant', 'Nos Box'])
        ->orderBy('id')
        ->get();
    
    return view('front.multipurpose.product.product', $data);
}

public function sandwichesMenus(Request $request)
{
    // ... (détection de langue) ...
    return view('front.multipurpose.product.sandwiches_menus', $data);
}
```

### Vue Principale
- **Fichier** : `resources/views/front/multipurpose/product/product.blade.php`
- **Fonctionnalité** : Affiche les cartes de catégories avec liens conditionnels
- **Logique** : "Sandwichs" et "Menus" pointent vers la même route

### Vue Unifiée
- **Fichier** : `resources/views/front/multipurpose/product/sandwiches_menus.blade.php`
- **Contenu** : Les 6 choix de plats avec prix et descriptions
- **Design** : Cartes colorées avec icônes et effets de survol

### Routes
```php
// Les deux URLs pointent vers la même méthode
Route::get('/menu/sandwichs', 'Front\ProductController@sandwichesMenus')->name('front.sandwiches');
Route::get('/menu/menus', 'Front\ProductController@sandwichesMenus')->name('front.menus');
```

## Utilisation

### Pour les Clients
1. **Accéder au menu** : Cliquer sur "Menu" depuis l'accueil
2. **Voir les catégories** : 6 cartes de catégories s'affichent
3. **Accéder aux sandwichs/menus** : Cliquer sur "Sandwichs" ou "Menus" (même résultat)
4. **Consulter les plats** : Voir les 6 choix avec prix et descriptions

### Pour les Administrateurs
1. **Modifier les catégories** : Éditer la base de données `pcategories`
2. **Modifier le contenu unifié** : Éditer `sandwiches_menus.blade.php`
3. **Personnaliser les styles** : Modifier le CSS inline dans la vue

## Test de la Fonctionnalité

### Test de la Page Principale
1. Accéder à l'accueil
2. Cliquer sur "Menu"
3. Vérifier que seules 6 catégories sont affichées
4. Vérifier que les images et descriptions sont correctes

### Test de la Page Unifiée
1. Cliquer sur "Sandwichs" → doit ouvrir la page unifiée
2. Cliquer sur "Menus" → doit ouvrir la même page unifiée
3. Vérifier que les 6 choix sont présents
4. Tester la responsivité sur mobile

### Test des Liens
1. Vérifier que les autres catégories pointent vers `front.items`
2. Vérifier que "Sandwichs" et "Menus" pointent vers `front.sandwiches`

## Personnalisation

### Modifier les Catégories
Pour changer les catégories affichées, modifier la requête dans `ProductController@product` :
```php
->whereIn('name', ['Nouvelle Catégorie 1', 'Nouvelle Catégorie 2', ...])
```

### Modifier le Contenu Unifié
Éditer directement `sandwiches_menus.blade.php` pour :
- Changer les noms des plats
- Modifier les prix
- Ajuster les descriptions
- Personnaliser les couleurs

### Modifier les Styles
Le CSS est intégré directement dans la vue pour faciliter la maintenance.

## Dépannage

### Problèmes Courants
1. **Catégories manquantes** : Vérifier la base de données `pcategories`
2. **Liens cassés** : Vérifier les routes dans `web.php`
3. **Erreurs d'affichage** : Vérifier la syntaxe Blade dans les vues

### Vérifications
- Les catégories ont-elles `status = 1` ?
- Les catégories ont-elles le bon `language_id` ?
- Les routes sont-elles correctement définies ?
- Les vues existent-elles dans le bon répertoire ?

## Version
**2.0** - Implémentation de la page unifiée Sandwichs & Menus

## Historique des Changements
- **v1.0** : Page de menu avec catégories filtrées
- **v2.0** : Page unifiée pour Sandwichs et Menus avec 6 choix spécifiés
