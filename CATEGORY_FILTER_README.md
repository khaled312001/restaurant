# Filtrage par Catégorie - Menu Restaurant King Kebab

## Vue d'ensemble

Cette fonctionnalité permet aux utilisateurs de filtrer les produits du menu par catégorie spécifique. Lorsqu'un utilisateur clique sur une catégorie (comme "Assiettes"), il est redirigé vers une page affichant uniquement les produits de cette catégorie.

## URL de fonctionnement

- **Page principale des menus**: `http://127.0.0.1:8000/menus`
- **Filtrage par catégorie**: `http://127.0.0.1:8000/menus?category_id=23`

## Implémentation technique

### 1. Contrôleur (ProductController.php)

La méthode `product()` a été modifiée pour :
- Détecter le paramètre `category_id` dans la requête
- Récupérer la catégorie sélectionnée
- Filtrer les produits par cette catégorie
- Passer les données à la vue

```php
public function product(Request $request)
{
    // ... code existant ...
    
    // Récupérer la catégorie sélectionnée si category_id est fourni
    $selectedCategory = null;
    if ($request->has('category_id')) {
        $selectedCategory = Pcategory::where('id', $request->category_id)
            ->where('language_id', $lang_id)
            ->where('status', 1)
            ->first();
    }

    // Construire la requête des produits
    $productsQuery = Product::where('language_id', $lang_id)->where('status', 1);
    
    // Filtrer par catégorie si une catégorie est sélectionnée
    if ($selectedCategory) {
        $productsQuery->where('category_id', $selectedCategory->id);
    }

    $data['products'] = $productsQuery->paginate(10);
    $data['selectedCategory'] = $selectedCategory;

    return view('front.multipurpose.product.product', $data);
}
```

### 2. Vue (product.blade.php)

La vue a été enrichie avec :
- Une section conditionnelle pour afficher les produits de catégorie
- Un bouton de retour aux catégories
- Une grille de produits avec pagination
- Des styles CSS personnalisés

#### Section des produits de catégorie

```blade
@if(isset($selectedCategory))
    <section class="category-products-area pt-80 pb-80">
        <!-- En-tête avec nom de la catégorie -->
        <!-- Bouton retour -->
        <!-- Liste des produits -->
        <!-- Pagination -->
    </section>
@endif
```

### 3. Routes

La route existante `/menus` gère maintenant le paramètre `category_id` :
```php
Route::get('/menus', 'Front\ProductController@product')->name('front.product');
```

## Fonctionnalités

### ✅ Implémentées
- [x] Filtrage des produits par catégorie
- [x] Affichage conditionnel des produits
- [x] Bouton de retour aux catégories
- [x] Pagination des résultats
- [x] Gestion des cas où aucun produit n'est disponible
- [x] Styles CSS responsifs
- [x] Support multilingue

### 🔄 Comportement
1. **Page principale** : Affiche toutes les catégories disponibles
2. **Clic sur catégorie** : Redirige vers `/menus?category_id=X`
3. **Filtrage** : Affiche uniquement les produits de la catégorie sélectionnée
4. **Navigation** : Bouton retour pour revenir à la vue des catégories

## Structure des données

### Variables passées à la vue
- `$categories` : Toutes les catégories actives
- `$products` : Produits filtrés (ou tous si aucune catégorie sélectionnée)
- `$selectedCategory` : Catégorie actuellement sélectionnée (null si aucune)

### Modèles utilisés
- `Pcategory` : Gestion des catégories de produits
- `Product` : Gestion des produits avec filtrage par catégorie

## Styles CSS

### Classes principales
- `.category-products-area` : Conteneur principal de la section produits
- `.product-card` : Carte individuelle de produit
- `.back-to-categories-btn` : Bouton de retour
- `.featured-badge` : Badge pour les produits populaires

### Responsive
- Adaptation mobile avec `@media (max-width: 768px)`
- Grille flexible avec Bootstrap
- Boutons et cartes optimisés pour mobile

## Tests

### Script de test
Un script `test_category_filter.php` est disponible pour vérifier :
- L'existence des routes
- La logique du contrôleur
- La structure de la vue
- L'état de la base de données

### Test manuel
1. Accéder à `/menus`
2. Cliquer sur une catégorie
3. Vérifier l'URL et le filtrage
4. Tester le bouton retour

## Maintenance

### Ajout de nouvelles catégories
1. Créer la catégorie dans la base de données
2. Ajouter le nom dans le filtre du contrôleur si nécessaire
3. Ajouter la description dans le switch de la vue

### Modification du design
- Les styles sont centralisés dans la section `<style>` de la vue
- Utilisation de variables CSS pour la cohérence des couleurs
- Classes Bootstrap pour la mise en page

## Dépannage

### Problèmes courants
1. **Produits non affichés** : Vérifier que `category_id` correspond à une catégorie active
2. **Erreur 404** : Vérifier que la route est bien définie
3. **Styles manquants** : Vérifier que la section CSS est bien chargée

### Logs
- Vérifier les logs Laravel dans `storage/logs/`
- Utiliser le script de test pour diagnostiquer les problèmes

## Évolutions futures

### Fonctionnalités potentielles
- [ ] Filtrage par prix
- [ ] Tri par popularité/prix
- [ ] Recherche textuelle
- [ ] Filtres multiples
- [ ] Cache des résultats

### Optimisations
- [ ] Mise en cache des requêtes
- [ ] Lazy loading des images
- [ ] API endpoints pour AJAX
- [ ] Indexation des produits

---

**Développé pour le restaurant King Kebab**  
*Dernière mise à jour : $(date)*

