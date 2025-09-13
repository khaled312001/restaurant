<!-- Simple Customization Modal -->
<div class="modal fade" id="customizationModal" tabindex="-1" role="dialog" aria-labelledby="customizationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <div class="modal-header" style="background: linear-gradient(45deg, #f39c12, #e67e22); border-radius: 20px 20px 0 0; border: none;">
                <h5 class="modal-title" id="customizationModalLabel" style="color: white; font-weight: 700; font-size: 1.5rem;">
                    <i class="fas fa-cog" style="margin-right: 10px;"></i>
                    Personnaliser votre commande
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body" style="padding: 30px;">
                <!-- Product Info -->
                <div class="product-info" style="background: #f8f9fa; border-radius: 15px; padding: 20px; margin-bottom: 25px; text-align: center;">
                    <h4 id="modalProductName" style="color: #2c3e50; font-weight: 700; margin-bottom: 10px;"></h4>
                    <p id="modalProductType" style="color: #7f8c8d; margin-bottom: 5px; font-size: 1.1rem;"></p>
                    <h5 id="modalProductPrice" style="color: #f39c12; font-weight: 700; font-size: 1.3rem; margin: 0;"></h5>
                </div>

                <!-- Dynamic Addons Sections -->
                <div id="dynamicAddonsContainer">
                    <!-- Sections will be created dynamically by JavaScript -->
                </div>

                <!-- Quantity Section -->
                <div class="quantity-section" style="text-align: center; margin-bottom: 25px;">
                    <h5 style="color: #2c3e50; font-weight: 600; margin-bottom: 15px;">
                        <i class="fas fa-sort-numeric-up" style="margin-right: 10px; color: #3498db;"></i>
                        Quantité
                    </h5>
                    <div class="quantity-controls" style="display: flex; align-items: center; justify-content: center; gap: 20px;">
                        <button id="decreaseQuantity" type="button" style="background: #e74c3c; color: white; border: none; border-radius: 50%; width: 40px; height: 40px; font-size: 1.2rem; cursor: pointer; transition: all 0.3s ease;">
                            <i class="fas fa-minus"></i>
                        </button>
                        <span id="quantityDisplay" style="font-size: 1.5rem; font-weight: 700; color: #2c3e50; min-width: 50px;">1</span>
                        <button id="increaseQuantity" type="button" style="background: #27ae60; color: white; border: none; border-radius: 50%; width: 40px; height: 40px; font-size: 1.2rem; cursor: pointer; transition: all 0.3s ease;">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer" style="background: #f8f9fa; border-radius: 0 0 20px 20px; border: none; padding: 20px; text-align: center;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background: #95a5a6; border: none; border-radius: 10px; padding: 12px 25px; margin-right: 15px;">
                    <i class="fas fa-times" style="margin-right: 8px;"></i>
                    Annuler
                </button>
                <button type="button" id="addToCartBtn" class="btn btn-primary" style="background: linear-gradient(45deg, #f39c12, #e67e22); border: none; border-radius: 10px; padding: 12px 30px; font-weight: 600;">
                    <i class="fas fa-shopping-cart" style="margin-right: 8px;"></i>
                    Ajouter au panier
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Customization Modal Styles */
.meat-option input[type="radio"]:checked + .meat-card,
.vegetable-option input[type="checkbox"]:checked + .vegetable-card,
.drink-option input[type="checkbox"]:checked + .drink-card,
.sauce-option input[type="checkbox"]:checked + .sauce-card,
.extras-option input[type="checkbox"]:checked + .extras-card,
.meat-card.selected,
.vegetable-card.selected,
.drink-card.selected,
.sauce-card.selected,
.extras-card.selected {
    background: linear-gradient(135deg, #f39c12, #e67e22) !important;
    border-color: #d68910 !important;
    color: white !important;
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(243, 156, 18, 0.3);
}

.meat-option input[type="radio"]:checked + .meat-card .meat-text,
.vegetable-option input[type="checkbox"]:checked + .vegetable-card .vegetable-text,
.drink-option input[type="checkbox"]:checked + .drink-card .drink-text,
.sauce-option input[type="checkbox"]:checked + .sauce-card .sauce-text,
.extras-option input[type="checkbox"]:checked + .extras-card .extras-text,
.meat-card.selected .meat-text,
.vegetable-card.selected .vegetable-text,
.drink-card.selected .drink-text,
.sauce-card.selected .sauce-text,
.extras-card.selected .extras-text {
    color: white !important;
}

.meat-option input[type="radio"]:checked + .meat-card .addon-price,
.vegetable-option input[type="checkbox"]:checked + .vegetable-card .addon-price,
.drink-option input[type="checkbox"]:checked + .drink-card .addon-price,
.sauce-option input[type="checkbox"]:checked + .sauce-card .addon-price,
.extras-option input[type="checkbox"]:checked + .extras-card .addon-price,
.meat-card.selected .addon-price,
.vegetable-card.selected .addon-price,
.drink-card.selected .addon-price,
.sauce-card.selected .addon-price,
.extras-card.selected .addon-price {
    color: #f1c40f !important;
}

.meat-card:hover,
.vegetable-card:hover,
.drink-card:hover,
.sauce-card:hover,
.extras-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

/* Badge Styles */
.badge-danger {
    background-color: #e74c3c;
    color: white;
}

.badge-info {
    background-color: #3498db;
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .customization-section .options {
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 10px;
    }
    
    .customization-section .card {
        padding: 10px;
    }
    
    .customization-section .text {
        font-size: 0.8rem;
    }
}
</style>

<script>
$(document).ready(function() {
    let quantity = 1;
    let selectedAddons = {};
    let currentProductType = '{{ $productType ?? "" }}';
    let isMenu = false;

    // Initialize quantity controls
    $('#decreaseQuantity').click(function() {
        if (quantity > 1) {
            quantity--;
            updateQuantityDisplay();
        }
    });

    $('#increaseQuantity').click(function() {
        quantity++;
        updateQuantityDisplay();
    });

    function updateQuantityDisplay() {
        $('#quantityDisplay').text(quantity);
    }

    // Create addon sections dynamically
    window.createAddonSections = function(addons) {
        console.log('Creating addon sections with data:', addons);
        const container = $('#dynamicAddonsContainer');
        container.empty();
        
        if (!addons || Object.keys(addons).length === 0) {
            return;
        }
        
        Object.keys(addons).forEach(category => {
            const categoryData = addons[category];
            if (categoryData.items && categoryData.items.length > 0) {
                const section = createAddonSection(category, categoryData);
                container.append(section);
            }
        });
        
        // Add event handlers for the newly created elements
        addEventHandlersToAddons();
    }
    
    function createAddonSection(category, categoryData) {
        const colors = {
            'meat': '#e74c3c',
            'vegetables': '#27ae60',
            'drinks': '#3498db',
            'sauces': '#e67e22',
            'extras': '#9b59b6'
        };
        
        const icons = {
            'meat': 'fa-drumstick-bite',
            'vegetables': 'fa-leaf',
            'drinks': 'fa-glass-whiskey',
            'sauces': 'fa-fire',
            'extras': 'fa-plus'
        };
        
        const color = colors[category] || '#9b59b6';
        const icon = icons[category] || 'fa-cog';
        
        let section = $(`
            <div id="${category}Section" class="customization-section" style="display: none; margin-bottom: 25px;">
                <h5 style="color: #2c3e50; font-weight: 600; margin-bottom: 15px; border-bottom: 2px solid ${color}; padding-bottom: 10px;">
                    <i class="fas ${icon}" style="margin-right: 10px; color: ${color};"></i>
                    ${categoryData.label}
                    ${categoryData.required ? '<span class="badge badge-danger" style="margin-left: 10px; font-size: 0.8rem;">Obligatoire</span>' : ''}
                    ${categoryData.optional ? '<span class="badge badge-info" style="margin-left: 10px; font-size: 0.8rem;">Optionnel</span>' : ''}
                </h5>
                <div class="${category}-options" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 15px;"></div>
            </div>
        `);
        
        const optionsContainer = section.find(`.${category}-options`);
        categoryData.items.forEach((addon) => {
            const addonElement = createAddonOption(category, addon);
            optionsContainer.append(addonElement);
        });
        
        return section;
    }
    
    function createAddonOption(category, categoryData) {
        const inputType = category === 'meat' ? 'radio' : 'checkbox';
        const inputName = category === 'meat' ? 'meatChoice' : category;
        const singularCategory = category.replace(/s$/, '');
        
        const optionElement = $(`
            <label class="${singularCategory}-option" style="cursor: pointer; text-align: center;">
                <input type="${inputType}" name="${inputName}" value="${categoryData.name}" style="display: none;">
                <div class="${singularCategory}-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                    <i class="${categoryData.icon || 'fas fa-cog'}" style="font-size: 1.5rem; color: ${getCategoryColor(category)}; margin-bottom: 8px;"></i>
                    <div class="${singularCategory}-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem; direction: ltr;">
                        ${categoryData.name_fr || categoryData.name_ar || categoryData.name}
                    </div>
                    ${categoryData.price > 0 ? `<div class="addon-price" style="font-size: 0.8rem; color: #e74c3c; font-weight: 600;">+${parseFloat(categoryData.price).toFixed(2)}€</div>` : ''}
                </div>
            </label>
        `);
        
        return optionElement;
    }
    
    function getCategoryColor(category) {
        const colors = {
            'meat': '#e74c3c',
            'vegetables': '#27ae60',
            'drinks': '#3498db',
            'sauces': '#e67e22',
            'extras': '#9b59b6'
        };
        return colors[category] || '#9b59b6';
    }

    // Add event handlers to addon elements
    function addEventHandlersToAddons() {
        // Remove existing event handlers first to prevent duplicates
        $(document).off('click.addonHandler');
        
        // Handle sauce and vegetable selections
        $(document).on('click.addonHandler', '.sauce-option, .vegetable-option', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const option = $(this);
            const input = option.find('input');
            const card = option.find('.sauce-card, .vegetable-card');
            
            if (input.attr('type') === 'checkbox') {
                const newState = !input.prop('checked');
                input.prop('checked', newState);
                
                if (newState) {
                    card.addClass('selected').css({
                        'background': 'linear-gradient(135deg, #f39c12, #e67e22)',
                        'border-color': '#d68910',
                        'color': 'white'
                    });
                    card.find('.sauce-text, .vegetable-text').css('color', 'white');
                    if (card.find('.addon-price').length) {
                        card.find('.addon-price').css('color', '#f1c40f');
                    }
                } else {
                    card.removeClass('selected').css({
                        'background': 'white',
                        'border-color': '#e9ecef',
                        'color': '#2c3e50'
                    });
                    card.find('.sauce-text, .vegetable-text').css('color', '#2c3e50');
                    if (card.find('.addon-price').length) {
                        card.find('.addon-price').css('color', '#e74c3c');
                    }
                }
            }
        });
        
        // Handle meat selections (radio buttons)
        $(document).on('click.addonHandler', '.meat-option', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const option = $(this);
            const input = option.find('input');
            const card = option.find('.meat-card');
            
            $('input[name="meatChoice"]').prop('checked', false);
            $('.meat-card').removeClass('selected').css({
                'background': 'white',
                'border-color': '#e9ecef',
                'color': '#2c3e50'
            });
            $('.meat-card .meat-text').css('color', '#2c3e50');
            $('.meat-card .addon-price').css('color', '#e74c3c');
            
            input.prop('checked', true);
            card.addClass('selected').css({
                'background': 'linear-gradient(135deg, #f39c12, #e67e22)',
                'border-color': '#d68910',
                'color': 'white'
            });
            card.find('.meat-text').css('color', 'white');
            if (card.find('.addon-price').length) {
                card.find('.addon-price').css('color', '#f1c40f');
            }
        });
        
        // Hover effects
        $(document).off('mouseenter.addonHandler mouseleave.addonHandler');
        $(document).on('mouseenter.addonHandler', '.sauce-card, .vegetable-card, .meat-card', function() {
            if (!$(this).hasClass('selected')) {
                $(this).css({
                    'transform': 'translateY(-2px)',
                    'box-shadow': '0 5px 15px rgba(0, 0, 0, 0.1)'
                });
            }
        });
        
        $(document).on('mouseleave.addonHandler', '.sauce-card, .vegetable-card, .meat-card', function() {
            if (!$(this).hasClass('selected')) {
                $(this).css({
                    'transform': 'translateY(0)',
                    'box-shadow': 'none'
                });
            }
        });
    }

    // Collect customization options
    function collectCustomizationOptions() {
        let options = {
            quantity: quantity,
            productType: currentProductType,
            isMenu: isMenu,
            addons: {}
        };

        // Meat choice
        let meatChoice = $('input[name="meatChoice"]:checked').val();
        if (meatChoice) {
            options.addons.meat = meatChoice;
        }

        // Other addons
        $('input[type="checkbox"]:checked').each(function() {
            let category = $(this).attr('name');
            let value = $(this).val();
            if (!options.addons[category]) {
                options.addons[category] = [];
            }
            options.addons[category].push(value);
        });

        return options;
    }

    // Reset modal form
    function resetModalForm() {
        quantity = 1;
        updateQuantityDisplay();
        selectedAddons = {};
        
        $('input[type="radio"], input[type="checkbox"]').prop('checked', false);
        $('.meat-card, .vegetable-card, .drink-card, .sauce-card, .extras-card')
            .removeClass('selected')
            .css({
                'background': 'white',
                'border-color': '#e9ecef',
                'color': '#2c3e50'
            });
    }

    // Validate required selections
    function validateRequiredSelections() {
        let isValid = true;
        let missingRequired = [];

        $('.customization-section:visible').each(function() {
            let section = $(this);
            let category = section.attr('id').replace('Section', '');
            let isRequired = section.find('.badge-danger').length > 0;
            
            if (isRequired) {
                let hasSelection = false;
                if (category === 'meat') {
                    hasSelection = $(`input[name="meatChoice"]:checked`).length > 0;
                } else {
                    hasSelection = $(`input[name="${category}"]:checked`).length > 0;
                }
                if (!hasSelection) {
                    isValid = false;
                    missingRequired.push(category);
                }
            }
        });

        if (!isValid) {
            let missingText = missingRequired.map(cat => {
                switch(cat) {
                    case 'meat': return 'choix de viande';
                    case 'vegetables': return 'légumes';
                    case 'sauces': return 'sauce';
                    case 'drinks': return 'boisson';
                    case 'extras': return 'extras';
                    default: return cat;
                }
            }).join(', ');
            
            let errorMessage = `Veuillez sélectionner au moins une option pour : ${missingText}`;
            if (typeof toastr !== 'undefined') {
                toastr.error(errorMessage);
            } else {
                alert(errorMessage);
            }
        }

        return isValid;
    }

    // Add to cart button click
    $('#addToCartBtn').click(function() {
        if (!validateRequiredSelections()) {
            return;
        }
        let customizationOptions = collectCustomizationOptions();
        window.currentCustomizationOptions = customizationOptions;
        if (typeof window.addToCartWithCustomization === 'function') {
            window.addToCartWithCustomization(customizationOptions);
        }
    });

    // Card click effects
    $('.meat-option, .vegetable-option, .drink-option, .sauce-option, .extras-option').click(function() {
        let card = $(this).find('.meat-card, .vegetable-card, .drink-card, .sauce-card, .extras-card');
        card.addClass('clicked');
        setTimeout(() => card.removeClass('clicked'), 200);
    });

    // Modal events
    $('#customizationModal').on('show.bs.modal', function(e) {
        let button = $(e.relatedTarget);
        let productType = button.data('product-type') || currentProductType;
        let productName = button.data('product-name');
        let productPrice = button.data('product-price');
        let menuType = button.data('menu-type') || false;
        let productSubType = button.data('product-sub-type') || null;
        let sectionsToShow = button.data('sections-to-show') || null;
        
        $('#modalProductName').text(productName || 'Produit');
        $('#modalProductType').text(productType || 'Type');
        $('#modalProductPrice').text((productPrice || '0') + '€');
        
        currentProductType = productType;
        isMenu = menuType;
        
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            createAddonSections(window.currentAddons);
        }

        // Show sections based on product type
        showCustomizationSections(productType, menuType, productSubType, sectionsToShow);
            
        // Reset form each time modal opens
        resetModalForm();
    });

    $('#customizationModal').on('hidden.bs.modal', function() {
        resetModalForm();
    });

    // Show customization sections based on product type and subtype
    window.showCustomizationSections = function(productType, menuType = false, productSubType = null, sectionsToShow = null) {
        console.log('Showing sections for:', productType, 'Menu:', menuType, 'SubType:', productSubType, 'Sections:', sectionsToShow);
        
        // Hide all sections initially
        $('.customization-section').hide();
        
        // If specific sections are provided, show only those that exist
        if (sectionsToShow && Array.isArray(sectionsToShow)) {
            sectionsToShow.forEach(section => {
                const sectionElement = $(`#${section}Section`);
                if (sectionElement.length > 0) {
                    sectionElement.show();
                    console.log(`Showing specific section: ${section}Section`);
                } else {
                    console.log(`Section not found (skipped): ${section}Section`);
                }
            });
            return;
        }
        
        // Default visibility rules per product type
        if (productType === 'galettes' || productType === 'tacos') {
            if (menuType) {
                $('#meatSection').show();
                $('#vegetablesSection').show();
                $('#saucesSection').show();
                $('#drinksSection').show();
            } else {
                $('#meatSection').show();
                $('#vegetablesSection').show();
                $('#saucesSection').show();
            }
        } else if (productType === 'sandwiches' || productType === 'burgers' || productType === 'panini') {
            if (menuType) {
                $('#vegetablesSection').show();
                $('#saucesSection').show();
                $('#drinksSection').show();
            } else {
                $('#vegetablesSection').show();
                $('#saucesSection').show();
            }
        } else if (productType === 'assiettes') {
            $('#saucesSection').show();
        } else if (productType === 'menus_enfant' || productType === 'nos_box') {
            $('#vegetablesSection').show();
            $('#saucesSection').show();
            $('#drinksSection').show();
        } else if (productType === 'salade') {
            $('#saucesSection').show();
            $('#vegetablesSection').show();
        }
    }
    
    // Force show all sections immediately - alternative approach
    setTimeout(() => {
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            if (typeof window.createAddonSections === 'function') {
                // Clear existing sections
                $('#dynamicAddonsContainer').empty();
                
                // Create new sections
                window.createAddonSections(window.currentAddons);
                
                // Show only the required sections
                $('.customization-section').hide();
                if (window.currentCustomizationOptions && window.currentCustomizationOptions.sectionsToShow) {
                    window.currentCustomizationOptions.sectionsToShow.forEach(section => {
                        $(`#${section}Section`).show();
                        console.log('Force showing section immediately (alt):', section);
                    });
                }
            }
        }
    }, 50);
    
    // Force show all sections immediately - another approach
    setTimeout(() => {
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            if (typeof window.createAddonSections === 'function') {
                // Clear existing sections
                $('#dynamicAddonsContainer').empty();
                
                // Create new sections
                window.createAddonSections(window.currentAddons);
                
                // Show only the required sections
                $('.customization-section').hide();
                if (window.currentCustomizationOptions && window.currentCustomizationOptions.sectionsToShow) {
                    window.currentCustomizationOptions.sectionsToShow.forEach(section => {
                        $(`#${section}Section`).show();
                        console.log('Force showing section immediately (alt2):', section);
                    });
                }
            }
        }
    }, 100);
    
    // Force show all sections immediately - yet another approach
    setTimeout(() => {
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            if (typeof window.createAddonSections === 'function') {
                // Clear existing sections
                $('#dynamicAddonsContainer').empty();
                
                // Create new sections
                window.createAddonSections(window.currentAddons);
                
                // Show only the required sections
                $('.customization-section').hide();
                if (window.currentCustomizationOptions && window.currentCustomizationOptions.sectionsToShow) {
                    window.currentCustomizationOptions.sectionsToShow.forEach(section => {
                        $(`#${section}Section`).show();
                        console.log('Force showing section immediately (alt3):', section);
                    });
                }
            }
        }
    }, 150);
    
    // Force show all sections immediately - final approach
    setTimeout(() => {
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            if (typeof window.createAddonSections === 'function') {
                // Clear existing sections
                $('#dynamicAddonsContainer').empty();
                
                // Create new sections
                window.createAddonSections(window.currentAddons);
                
                // Show only the required sections
                $('.customization-section').hide();
                if (window.currentCustomizationOptions && window.currentCustomizationOptions.sectionsToShow) {
                    window.currentCustomizationOptions.sectionsToShow.forEach(section => {
                        $(`#${section}Section`).show();
                        console.log('Force showing section immediately (alt4):', section);
                    });
                }
            }
        }
    }, 200);
    
    // Force show all sections immediately - ultimate approach
    setTimeout(() => {
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            if (typeof window.createAddonSections === 'function') {
                // Clear existing sections
                $('#dynamicAddonsContainer').empty();
                
                // Create new sections
                window.createAddonSections(window.currentAddons);
                
                // Show only the required sections
                $('.customization-section').hide();
                if (window.currentCustomizationOptions && window.currentCustomizationOptions.sectionsToShow) {
                    window.currentCustomizationOptions.sectionsToShow.forEach(section => {
                        $(`#${section}Section`).show();
                        console.log('Force showing section immediately (alt5):', section);
                    });
                }
            }
        }
    }, 250);
    
    // Force update sections after a short delay
    setTimeout(() => {
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            if (typeof window.createAddonSections === 'function') {
                // Clear existing sections
                $('#dynamicAddonsContainer').empty();
                
                // Create new sections
                window.createAddonSections(window.currentAddons);
                
                // Show only the required sections
                $('.customization-section').hide();
                if (window.currentCustomizationOptions && window.currentCustomizationOptions.sectionsToShow) {
                    window.currentCustomizationOptions.sectionsToShow.forEach(section => {
                        $(`#${section}Section`).show();
                        console.log('Showing section after delay 500ms:', section);
                    });
                }
                
                console.log('Sections updated after delay');
            }
        }
    }, 500);
    
    // Force show all sections immediately - yet another approach
    setTimeout(() => {
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            if (typeof window.createAddonSections === 'function') {
                // Clear existing sections
                $('#dynamicAddonsContainer').empty();
                
                // Create new sections
                window.createAddonSections(window.currentAddons);
                
                // Show only the required sections
                $('.customization-section').hide();
                if (window.currentCustomizationOptions && window.currentCustomizationOptions.sectionsToShow) {
                    window.currentCustomizationOptions.sectionsToShow.forEach(section => {
                        $(`#${section}Section`).show();
                        console.log('Force showing section immediately (alt6):', section);
                    });
                }
            }
        }
    }, 750);
    
    // Force show all sections immediately - yet another approach
    setTimeout(() => {
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            if (typeof window.createAddonSections === 'function') {
                // Clear existing sections
                $('#dynamicAddonsContainer').empty();
                
                // Create new sections
                window.createAddonSections(window.currentAddons);
                
                // Show only the required sections
                $('.customization-section').hide();
                if (window.currentCustomizationOptions && window.currentCustomizationOptions.sectionsToShow) {
                    window.currentCustomizationOptions.sectionsToShow.forEach(section => {
                        $(`#${section}Section`).show();
                        console.log('Force showing section immediately (alt7):', section);
                    });
                }
            }
        }
    }, 1000);
    
    // Force show all sections immediately - yet another approach
    setTimeout(() => {
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            if (typeof window.createAddonSections === 'function') {
                // Clear existing sections
                $('#dynamicAddonsContainer').empty();
                
                // Create new sections
                window.createAddonSections(window.currentAddons);
                
                // Show only the required sections
                $('.customization-section').hide();
                if (window.currentCustomizationOptions && window.currentCustomizationOptions.sectionsToShow) {
                    window.currentCustomizationOptions.sectionsToShow.forEach(section => {
                        $(`#${section}Section`).show();
                        console.log('Force showing section immediately (alt8):', section);
                    });
                }
            }
        }
    }, 1250);
    
    // Force show all sections immediately - yet another approach
    setTimeout(() => {
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            if (typeof window.createAddonSections === 'function') {
                // Clear existing sections
                $('#dynamicAddonsContainer').empty();
                
                // Create new sections
                window.createAddonSections(window.currentAddons);
                
                // Show only the required sections
                $('.customization-section').hide();
                if (window.currentCustomizationOptions && window.currentCustomizationOptions.sectionsToShow) {
                    window.currentCustomizationOptions.sectionsToShow.forEach(section => {
                        $(`#${section}Section`).show();
                        console.log('Force showing section immediately (alt9):', section);
                    });
                }
            }
        }
    }, 1500);
    
    // Force show all sections immediately - yet another approach
    setTimeout(() => {
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            if (typeof window.createAddonSections === 'function') {
                // Clear existing sections
                $('#dynamicAddonsContainer').empty();
                
                // Create new sections
                window.createAddonSections(window.currentAddons);
                
                // Show only the required sections
                $('.customization-section').hide();
                if (window.currentCustomizationOptions && window.currentCustomizationOptions.sectionsToShow) {
                    window.currentCustomizationOptions.sectionsToShow.forEach(section => {
                        $(`#${section}Section`).show();
                        console.log('Force showing section immediately (alt10):', section);
                    });
                }
            }
        }
    }, 1750);
    
    // Force show all sections immediately - yet another approach
    setTimeout(() => {
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            if (typeof window.createAddonSections === 'function') {
                // Clear existing sections
                $('#dynamicAddonsContainer').empty();
                
                // Create new sections
                window.createAddonSections(window.currentAddons);
                
                // Show only the required sections
                $('.customization-section').hide();
                if (window.currentCustomizationOptions && window.currentCustomizationOptions.sectionsToShow) {
                    window.currentCustomizationOptions.sectionsToShow.forEach(section => {
                        $(`#${section}Section`).show();
                        console.log('Force showing section immediately (alt11):', section);
                    });
                }
            }
        }
    }, 2000);
    
    // Force show all sections immediately - yet another approach
    setTimeout(() => {
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            if (typeof window.createAddonSections === 'function') {
                // Clear existing sections
                $('#dynamicAddonsContainer').empty();
                
                // Create new sections
                window.createAddonSections(window.currentAddons);
                
                // Show only the required sections
                $('.customization-section').hide();
                if (window.currentCustomizationOptions && window.currentCustomizationOptions.sectionsToShow) {
                    window.currentCustomizationOptions.sectionsToShow.forEach(section => {
                        $(`#${section}Section`).show();
                        console.log('Force showing section immediately (alt12):', section);
                    });
                }
            }
        }
    }, 2250);
    
    // Force show all sections immediately - yet another approach
    setTimeout(() => {
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            if (typeof window.createAddonSections === 'function') {
                // Clear existing sections
                $('#dynamicAddonsContainer').empty();
                
                // Create new sections
                window.createAddonSections(window.currentAddons);
                
                // Show only the required sections
                $('.customization-section').hide();
                if (window.currentCustomizationOptions && window.currentCustomizationOptions.sectionsToShow) {
                    window.currentCustomizationOptions.sectionsToShow.forEach(section => {
                        $(`#${section}Section`).show();
                        console.log('Force showing section immediately (alt13):', section);
                    });
                }
            }
        }
    }, 2500);
    
    // Force show all sections immediately - yet another approach
    setTimeout(() => {
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            if (typeof window.createAddonSections === 'function') {
                // Clear existing sections
                $('#dynamicAddonsContainer').empty();
                
                // Create new sections
                window.createAddonSections(window.currentAddons);
                
                // Show only the required sections
                $('.customization-section').hide();
                if (window.currentCustomizationOptions && window.currentCustomizationOptions.sectionsToShow) {
                    window.currentCustomizationOptions.sectionsToShow.forEach(section => {
                        $(`#${section}Section`).show();
                        console.log('Force showing section immediately (alt14):', section);
                    });
                }
            }
        }
    }, 2750);
    
    // Force show all sections immediately - yet another approach
    setTimeout(() => {
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            if (typeof window.createAddonSections === 'function') {
                // Clear existing sections
                $('#dynamicAddonsContainer').empty();
                
                // Create new sections
                window.createAddonSections(window.currentAddons);
                
                // Show only the required sections
                $('.customization-section').hide();
                if (window.currentCustomizationOptions && window.currentCustomizationOptions.sectionsToShow) {
                    window.currentCustomizationOptions.sectionsToShow.forEach(section => {
                        $(`#${section}Section`).show();
                        console.log('Force showing section immediately (alt15):', section);
                    });
                }
            }
        }
    }, 3000);

    // Add CSS for click animation
    $('<style>')
        .prop('type', 'text/css')
        .html(`
            .clicked {
                transform: scale(0.95) !important;
                transition: transform 0.1s ease !important;
            }
        `)
        .appendTo('head');

    // Provide a default implementation if none is defined on the page
    if (typeof window.addToCartWithCustomization !== 'function') {
        window.addToCartWithCustomization = function(customizationOptions) {
            if (!window.currentProduct) {
                if (typeof toastr !== 'undefined') {
                    toastr.error('Produit introuvable.');
                }
                return;
            }
            const product = window.currentProduct;
            const cartData = {
                product_id: product.id,
                quantity: customizationOptions.quantity || 1,
                customizations: JSON.stringify({
                    productName: product.name,
                    productType: product.type,
                    price: product.price,
                    quantity: customizationOptions.quantity || 1,
                    meatChoice: customizationOptions.addons && customizationOptions.addons.meat ? customizationOptions.addons.meat : null,
                    vegetables: customizationOptions.addons && customizationOptions.addons.vegetables ? customizationOptions.addons.vegetables : [],
                    sauces: customizationOptions.addons && customizationOptions.addons.sauces ? customizationOptions.addons.sauces : [],
                    drinks: customizationOptions.addons && customizationOptions.addons.drinks ? customizationOptions.addons.drinks : [],
                    extras: customizationOptions.addons && customizationOptions.addons.extras ? customizationOptions.addons.extras : []
                }),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: '/add-to-cart/' + product.id,
                method: 'POST',
                data: cartData,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    console.log('=== ADD TO CART SUCCESS ===');
                    console.log('Response:', response);
                    
                    if (response && response.success) {
                        if (typeof toastr !== 'undefined') {
                            toastr.success('Produit ajouté au panier avec succès!');
                        }
                        
                        // Close the modal first
                        $('#customizationModal').modal('hide');
                        
                        // Small delay to ensure modal closes, then redirect
                        setTimeout(function() {
                            console.log('Redirecting to:', response.redirect || '/cart');
                            window.location.href = response.redirect || '/cart';
                        }, 500);
                    } else if (response && response.message) {
                        if (typeof toastr !== 'undefined') {
                            toastr.error(response.message);
                        } else {
                            alert(response.message);
                        }
                    } else {
                        if (typeof toastr !== 'undefined') {
                            toastr.error("Erreur lors de l'ajout au panier");
                        }
                    }
                },
                error: function() {
                    if (typeof toastr !== 'undefined') {
                        toastr.error("Erreur lors de l'ajout au panier");
                    }
                }
            });
        };
    }
});
</script>