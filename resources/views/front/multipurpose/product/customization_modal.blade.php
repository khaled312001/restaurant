<!-- Customization Modal -->
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
                @if(isset($addons))
                    @foreach($addons as $category => $categoryData)
                        @if(count($categoryData['items']) > 0)
                            <div id="{{ $category }}Section" class="customization-section" style="display: none; margin-bottom: 25px;">
                                <h5 style="color: #2c3e50; font-weight: 600; margin-bottom: 15px; border-bottom: 2px solid {{ $category == 'meat' ? '#e74c3c' : ($category == 'vegetables' ? '#27ae60' : ($category == 'drinks' ? '#3498db' : ($category == 'sauces' ? '#e67e22' : '#9b59b6'))) }}; padding-bottom: 10px;">
                                    <i class="fas {{ $category == 'meat' ? 'fa-drumstick-bite' : ($category == 'vegetables' ? 'fa-leaf' : ($category == 'drinks' ? 'fa-glass-whiskey' : ($category == 'sauces' ? 'fa-fire' : 'fa-plus'))) }}" style="margin-right: 10px; color: {{ $category == 'meat' ? '#e74c3c' : ($category == 'vegetables' ? '#27ae60' : ($category == 'drinks' ? '#3498db' : ($category == 'sauces' ? '#e67e22' : '#9b59b6'))) }};"></i>
                                    {{ $categoryData['label'] }}
                                    @if(isset($categoryData['required']) && $categoryData['required'])
                                        <span class="badge badge-danger" style="margin-left: 10px; font-size: 0.8rem;">Obligatoire</span>
                                    @elseif(isset($categoryData['optional']) && $categoryData['optional'])
                                        <span class="badge badge-info" style="margin-left: 10px; font-size: 0.8rem;">Optionnel</span>
                                    @endif
                                </h5>
                                <div class="{{ $category }}-options" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 15px;">
                                    @foreach($categoryData['items'] as $addon)
                                        <label class="{{ $category }}-option" style="cursor: pointer; text-align: center;">
                                            @if($category == 'meat')
                                                <input type="radio" name="meatChoice" value="{{ $addon->name }}" style="display: none;">
                                            @else
                                                <input type="checkbox" name="{{ $category }}" value="{{ $addon->name }}" style="display: none;">
                                            @endif
                                            <div class="{{ $category }}-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                                <i class="{{ $addon->icon ?? 'fas fa-cog' }}" style="font-size: 1.5rem; color: {{ $category == 'meat' ? '#e74c3c' : ($category == 'vegetables' ? '#27ae60' : ($category == 'drinks' ? '#3498db' : ($category == 'sauces' ? '#e67e22' : '#9b59b6'))) }}; margin-bottom: 8px;"></i>
                                                <div class="{{ $category }}-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">{{ $addon->name }}</div>
                                                @if($addon->price > 0)
                                                    <div class="addon-price" style="font-size: 0.8rem; color: #e74c3c; font-weight: 600;">+{{ number_format($addon->price, 2) }}€</div>
                                                @endif
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif

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
.extras-option input[type="checkbox"]:checked + .extras-card {
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
.extras-option input[type="checkbox"]:checked + .extras-card .extras-text {
    color: white !important;
}

.meat-option input[type="radio"]:checked + .meat-card .addon-price,
.vegetable-option input[type="checkbox"]:checked + .vegetable-card .addon-price,
.drink-option input[type="checkbox"]:checked + .drink-card .addon-price,
.sauce-option input[type="checkbox"]:checked + .sauce-card .addon-price,
.extras-option input[type="checkbox"]:checked + .extras-card .addon-price {
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
    .{{ $category }}-options {
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 10px;
    }
    
    .{{ $category }}-card {
        padding: 10px;
    }
    
    .{{ $category }}-text {
        font-size: 0.8rem;
    }
}
</style>

<script>
$(document).ready(function() {
    let quantity = 1;
    let selectedAddons = {};

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

    // Show customization sections based on product type
    function showCustomizationSections(productType) {
        // Hide all sections first
        $('.customization-section').hide();
        
        // Show sections based on product type
        if (productType === 'galettes' || productType === 'tacos') {
            // Show meat, vegetables, sauces, drinks
            $('#meatSection').show();
            $('#vegetablesSection').show();
            $('#saucesSection').show();
            $('#drinksSection').show();
        } else if (productType === 'sandwiches' || productType === 'burgers' || productType === 'panini') {
            // Show vegetables, sauces, drinks (no meat)
            $('#vegetablesSection').show();
            $('#saucesSection').show();
            $('#drinksSection').show();
        } else if (productType === 'assiettes') {
            // Show only sauces
            $('#saucesSection').show();
        } else if (productType === 'menus_enfant' || productType === 'nos_box') {
            // Show vegetables, sauces, drinks
            $('#vegetablesSection').show();
            $('#saucesSection').show();
            $('#drinksSection').show();
        } else if (productType === 'salade') {
            // Show sauces, optional vegetables
            $('#saucesSection').show();
            $('#vegetablesSection').show();
        }
    }

    // Collect customization options
    function collectCustomizationOptions() {
        let options = {
            quantity: quantity,
            addons: {}
        };

        // Collect meat choice (radio button)
        let meatChoice = $('input[name="meatChoice"]:checked').val();
        if (meatChoice) {
            options.addons.meat = meatChoice;
        }

        // Collect other addons (checkboxes)
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
        
        // Uncheck all inputs
        $('input[type="radio"], input[type="checkbox"]').prop('checked', false);
        
        // Reset card styles
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

        // Check each section for required addons
        $('.customization-section').each(function() {
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
                    default: return cat;
                }
            }).join(', ');
            
            alert(`Veuillez sélectionner : ${missingText}`);
        }

        return isValid;
    }

    // Add to cart button click
    $('#addToCartBtn').click(function() {
        if (!validateRequiredSelections()) {
            return;
        }

        let customizationOptions = collectCustomizationOptions();
        
        // Store customization options for the current product
        window.currentCustomizationOptions = customizationOptions;
        
        // Close modal
        $('#customizationModal').modal('hide');
        
        // Trigger add to cart (this should be handled by the parent page)
        if (typeof window.addToCartWithCustomization === 'function') {
            window.addToCartWithCustomization(customizationOptions);
        }
    });

    // Card click effects
    $('.meat-option, .vegetable-option, .drink-option, .sauce-option, .extras-option').click(function() {
        let card = $(this).find('.meat-card, .vegetable-card, .drink-card, .sauce-card, .extras-card');
        
        // Add click animation
        card.addClass('clicked');
        setTimeout(() => card.removeClass('clicked'), 200);
    });

    // Modal events
    $('#customizationModal').on('show.bs.modal', function(e) {
        let button = $(e.relatedTarget);
        let productType = button.data('product-type');
        let productName = button.data('product-name');
        let productPrice = button.data('product-price');
        
        // Update modal content
        $('#modalProductName').text(productName);
        $('#modalProductType').text(productType);
        $('#modalProductPrice').text(productPrice + '€');
        
        // Show appropriate sections
        showCustomizationSections(productType);
        
        // Reset form
        resetModalForm();
    });

    $('#customizationModal').on('hidden.bs.modal', function() {
        resetModalForm();
    });

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
});
</script> 