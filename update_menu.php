<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Get current language
$currentLang = App\Models\Language::where('is_default', 1)->first();
if (!$currentLang) {
    $currentLang = App\Models\Language::first();
}

// Create enhanced menu
$enhancedMenu = [
    [
        "text" => "Accueil",
        "href" => route('front.index'),
        "icon" => "fas fa-home",
        "target" => "_self",
        "title" => "Page d'accueil",
        "type" => "home"
    ],
    [
        "text" => "Notre Carte",
        "href" => route('front.sandwiches'),
        "icon" => "fas fa-utensils",
        "target" => "_self",
        "title" => "Découvrez notre carte",
        "type" => "menu_1",
        "children" => [
            [
                "text" => "Sandwichs & Menus",
                "href" => route('front.sandwiches'),
                "icon" => "fas fa-hamburger",
                "target" => "_self",
                "title" => "Sandwichs et menus",
                "type" => "sandwiches"
            ],
            [
                "text" => "Kebab & Galette",
                "href" => route('front.kebabGalette'),
                "icon" => "fas fa-drumstick-bite",
                "target" => "_self",
                "title" => "Kebab et galette",
                "type" => "kebab_galette"
            ],
            [
                "text" => "Americain & Kofte",
                "href" => route('front.americainKofte'),
                "icon" => "fas fa-hotdog",
                "target" => "_self",
                "title" => "Americain et kofte",
                "type" => "americain_kofte"
            ],
            [
                "text" => "Tacos",
                "href" => route('front.tacos'),
                "icon" => "fas fa-utensils",
                "target" => "_self",
                "title" => "Tacos mexicains",
                "type" => "tacos"
            ],
            [
                "text" => "Burgers",
                "href" => route('front.burgers'),
                "icon" => "fas fa-hamburger",
                "target" => "_self",
                "title" => "Burgers gourmets",
                "type" => "burgers"
            ],
            [
                "text" => "Panini",
                "href" => route('front.panini'),
                "icon" => "fas fa-bread-slice",
                "target" => "_self",
                "title" => "Panini gourmets",
                "type" => "panini"
            ],
            [
                "text" => "Assiettes",
                "href" => route('front.assiettes'),
                "icon" => "fas fa-utensils",
                "target" => "_self",
                "title" => "Assiettes complètes",
                "type" => "assiettes"
            ],
            [
                "text" => "Menus Enfant",
                "href" => route('front.menusEnfant'),
                "icon" => "fas fa-child",
                "target" => "_self",
                "title" => "Menus pour enfants",
                "type" => "menus_enfant"
            ],
            [
                "text" => "Salade",
                "href" => route('front.salade'),
                "icon" => "fas fa-leaf",
                "target" => "_self",
                "title" => "Salades fraîches",
                "type" => "salade"
            ],
            [
                "text" => "Nos Box",
                "href" => route('front.nosBox'),
                "icon" => "fas fa-box",
                "target" => "_self",
                "title" => "Nos box repas",
                "type" => "nos_box"
            ]
        ]
    ],
    [
        "text" => "À propos",
        "href" => route('front.about'),
        "icon" => "fas fa-info-circle",
        "target" => "_self",
        "title" => "À propos de nous",
        "type" => "about"
    ],
    [
        "text" => "Blogs",
        "href" => route('front.blogs'),
        "icon" => "fas fa-blog",
        "target" => "_self",
        "title" => "Nos articles",
        "type" => "blogs"
    ],
    [
        "text" => "Contact",
        "href" => route('front.contact'),
        "icon" => "fas fa-envelope",
        "target" => "_self",
        "title" => "Contactez-nous",
        "type" => "contact"
    ]
];

// Update or create menu
$menu = App\Models\Menu::where('language_id', $currentLang->id)->first();
if ($menu) {
    $menu->menus = json_encode($enhancedMenu);
    $menu->save();
    echo "Menu updated successfully for language ID: " . $currentLang->id . PHP_EOL;
} else {
    $menu = new App\Models\Menu();
    $menu->language_id = $currentLang->id;
    $menu->menus = json_encode($enhancedMenu);
    $menu->save();
    echo "Menu created successfully for language ID: " . $currentLang->id . PHP_EOL;
}

echo "Enhanced menu with " . count($enhancedMenu) . " main items created!" . PHP_EOL;