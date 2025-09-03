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

    // Show customization sections based on product type and subtype
    function showCustomizationSections(productType, menuType = false, productSubType = null, sectionsToShow = null) {
        console.log('Showing sections for:', productType, 'Menu:', menuType, 'SubType:', productSubType, 'Sections:', sectionsToShow);
        
        // Get all available sections
        const allSections = $('.customization-section');
        console.log('All available sections:', allSections.map(function() { return $(this).attr('id'); }).get());
        
        // Don't hide sections since we're forcing them to show
        // $('.customization-section').hide();
        console.log('Sections visibility preserved');
        
        // If specific sections are provided, show only those
        if (sectionsToShow && Array.isArray(sectionsToShow)) {
            sectionsToShow.forEach(section => {
                const sectionElement = $(`#${section}Section`);
                if (sectionElement.length > 0) {
                    sectionElement.show();
                    console.log(`Showing specific section: ${section}Section`);
                } else {
                    console.log(`Section not found: ${section}Section`);
                }
            });
            console.log('Showing specific sections:', sectionsToShow);
            return;
        }
        
        // Show sections based on product type and menu type
        if (productType === 'galettes' || productType === 'tacos') {
            if (menuType) {
                // Menu complet: Meat, Vegetables, Sauces, Drinks
                $('#meatSection').show();
                $('#vegetablesSection').show();
                $('#saucesSection').show();
                $('#drinksSection').show();
                console.log('Showing Menu sections for:', productType);
            } else {
                // Seul: Meat, Vegetables, Sauces (NO DRINKS)
                $('#meatSection').show();
                $('#vegetablesSection').show();
                $('#saucesSection').show();
                console.log('Showing Seul sections for:', productType);
            }
        } else if (productType === 'sandwiches' || productType === 'burgers' || productType === 'panini') {
            if (menuType) {
                // Menu complet: Vegetables, Sauces, Drinks
                $('#vegetablesSection').show();
                $('#saucesSection').show();
                $('#drinksSection').show();
                console.log('Showing Menu sections for:', productType);
            } else {
                // Seul: Vegetables, Sauces (NO DRINKS, NO MEAT)
                $('#vegetablesSection').show();
                $('#saucesSection').show();
                console.log('Showing Seul sections for:', productType);
            }
        } else if (productType === 'assiettes') {
            // Only sauces - nothing else
            $('#saucesSection').show();
            console.log('Showing only sauces for assiettes');
        } else if (productType === 'menus_enfant' || productType === 'nos_box') {
            // Vegetables, Sauces, Drinks (always complete)
            $('#vegetablesSection').show();
            $('#saucesSection').show();
            $('#drinksSection').show();
            console.log('Showing complete sections for:', productType);
        } else if (productType === 'salade') {
            // Sauces (required), Vegetables (optional)
            $('#saucesSection').show();
            $('#vegetablesSection').show();
            console.log('Showing salade sections');
        }
        
        console.log('Sections shown for:', productType);
        
        // Log which sections are visible
        $('.customization-section').each(function() {
            let section = $(this);
            let category = section.attr('id').replace('Section', '');
            let isVisible = section.is(':visible');
            console.log(`Section ${category}: ${isVisible ? 'Visible' : 'Hidden'}`);
        });
        
        // Force show sections if they're still hidden
        $('.customization-section').each(function() {
            let section = $(this);
            let category = section.attr('id').replace('Section', '');
            let isVisible = section.is(':visible');
            
            if (!isVisible) {
                console.log(`Forcing show of hidden section: ${category}`);
                section.show();
            }
        });
        
        console.log('Final section visibility check:');
        $('.customization-section').each(function() {
            let section = $(this);
            let category = section.attr('id').replace('Section', '');
            let isVisible = section.is(':visible');
            console.log(`Final - Section ${category}: ${isVisible ? 'Visible' : 'Hidden'}`);
        });
    }

    // Create addon sections dynamically
    function createAddonSections(addons) {
        console.log('Creating addon sections with data:', addons);
        console.log('Addons type:', typeof addons);
        console.log('Addons keys:', Object.keys(addons || {}));
        
        const container = $('#dynamicAddonsContainer');
        console.log('Container found:', container.length > 0);
        container.empty();
        
        if (!addons || Object.keys(addons).length === 0) {
            console.log('No addons data available');
            return;
        }
        
        Object.keys(addons).forEach(category => {
            console.log('Processing category:', category);
            const categoryData = addons[category];
            console.log('Category data:', categoryData);
            
            if (categoryData.items && categoryData.items.length > 0) {
                console.log('Creating section for category:', category, 'with', categoryData.items.length, 'items');
                const section = createAddonSection(category, categoryData);
                container.append(section);
                console.log('Section created and appended for:', category);
            } else {
                console.log('No items for category:', category);
            }
        });
        
        console.log('Total sections created:', container.find('.customization-section').length);
        
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
        
        console.log(`Creating section with ID: ${category}Section for category: ${category}`);
        
        let section = $(`
            <div id="${category}Section" class="customization-section" style="display: none; margin-bottom: 25px;">
                <h5 style="color: #2c3e50; font-weight: 600; margin-bottom: 15px; border-bottom: 2px solid ${color}; padding-bottom: 10px;">
                    <i class="fas ${icon}" style="margin-right: 10px; color: ${color};"></i>
                    ${categoryData.label}
                    ${categoryData.required ? '<span class="badge badge-danger" style="margin-left: 10px; font-size: 0.8rem;">Obligatoire</span>' : ''}
                    ${categoryData.optional ? '<span class="badge badge-info" style="margin-left: 10px; font-size: 0.8rem;">Optionnel</span>' : ''}
                </h5>
                <div class="${category}-options" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 15px;">
                </div>
            </div>
        `);
        
        const optionsContainer = section.find(`.${category}-options`);
        console.log(`Options container found:`, optionsContainer.length > 0);
        
        categoryData.items.forEach((addon, index) => {
            console.log(`Creating addon ${index + 1}/${categoryData.items.length}:`, addon.name);
            const addonElement = createAddonOption(category, addon);
            optionsContainer.append(addonElement);
        });
        
        console.log(`Section created successfully: ${category}Section`);
        return section;
    }
    
    function createAddonOption(category, categoryData) {
        const inputType = category === 'meat' ? 'radio' : 'checkbox';
        const inputName = category === 'meat' ? 'meatChoice' : category;
        
        // Use singular class names for consistency
        const singularCategory = category.replace(/s$/, ''); // Remove 's' from end
        
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
        
        console.log(`Created ${singularCategory} option:`, optionElement.attr('class'), 'Input:', optionElement.find('input').length);
        
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
        console.log('Adding event handlers to addon elements');
        
        // Remove existing event handlers first to prevent duplicates
        $(document).off('click.addonHandler');
        
        // Handle sauce and vegetable selections
        $(document).on('click.addonHandler', '.sauce-option, .vegetable-option', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const option = $(this);
            const input = option.find('input');
            const card = option.find('.sauce-card, .vegetable-card');
            
            console.log('Addon option clicked:', option.attr('class'));
            console.log('Input element:', input);
            console.log('Card element:', card);
            console.log('Current input state:', input.prop('checked'));
            
            if (input.attr('type') === 'checkbox') {
                // Toggle checkbox
                const newState = !input.prop('checked');
                input.prop('checked', newState);
                
                console.log('New input state:', newState);
                
                if (newState) {
                    console.log('Adding selected class and styling');
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
                    console.log('Removing selected class and styling');
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
            
            console.log('Final input state:', input.prop('checked'));
            console.log('Card classes:', card.attr('class'));
        });
        
        // Handle meat selections (radio buttons)
        $(document).on('click.addonHandler', '.meat-option', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const option = $(this);
            const input = option.find('input');
            const card = option.find('.meat-card');
            
            console.log('Meat option clicked:', option.attr('class'));
            console.log('Input element:', input);
            console.log('Card element:', card);
            
            // Uncheck all other meat options
            $('input[name="meatChoice"]').prop('checked', false);
            $('.meat-card').removeClass('selected').css({
                'background': 'white',
                'border-color': '#e9ecef',
                'color': '#2c3e50'
            });
            $('.meat-card .meat-text').css('color', '#2c3e50');
            $('.meat-card .addon-price').css('color', '#e74c3c');
            
            // Check this option
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
            
            console.log('Meat selection:', input.val());
            console.log('Card classes:', card.attr('class'));
        });
        
        // Add hover effects
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
        
        console.log('Event handlers added successfully');
        
        // Test if elements are clickable
        setTimeout(() => {
            const sauceOptions = $('.sauce-option');
            const vegetableOptions = $('.vegetable-option');
            console.log('Found sauce options:', sauceOptions.length);
            console.log('Found vegetable options:', vegetableOptions.length);
            
            // Test direct click binding
            if (sauceOptions.length > 0) {
                console.log('Testing direct click binding...');
                sauceOptions.each(function(index) {
                    const option = $(this);
                    const input = option.find('input');
                    const card = option.find('.sauce-card, .vegetable-card');
                    
                    console.log(`Option ${index}:`, {
                        'class': option.attr('class'),
                        'input': input.length,
                        'card': card.length,
                        'has-click-handler': option.data('click-bound')
                    });
                    
                    // Bind direct click handler for testing
                    option.off('click.testHandler').on('click.testHandler', function(e) {
                        console.log(`Direct click test on option ${index}`);
                        e.preventDefault();
                        e.stopPropagation();
                        
                        const currentInput = $(this).find('input');
                        const currentCard = $(this).find('.sauce-card, .vegetable-card');
                        const currentState = currentInput.prop('checked');
                        
                        console.log(`Direct click - Current state: ${currentState}`);
                        
                        // Toggle state
                        currentInput.prop('checked', !currentState);
                        console.log(`Direct click - New state: ${currentInput.prop('checked')}`);
                        
                        // Update styling
                        if (currentInput.prop('checked')) {
                            currentCard.addClass('selected').css({
                                'background': 'linear-gradient(135deg, #f39c12, #e67e22)',
                                'border-color': '#d68910',
                                'color': 'white'
                            });
                            currentCard.find('.sauce-text, .vegetable-text').css('color', 'white');
                        } else {
                            currentCard.removeClass('selected').css({
                                'background': 'white',
                                'border-color': '#e9ecef',
                                'color': '#2c3e50'
                            });
                            currentCard.find('.sauce-text, .vegetable-text').css('color', '#2c3e50');
                        }
                        
                        console.log(`Direct click - Card classes: ${currentCard.attr('class')}`);
                    });
                    
                    // Mark as bound
                    option.data('click-bound', true);
                });
                
                console.log('Direct click handlers bound to all options');
            }
            
            // If elements not found, retry with longer delay
            if (sauceOptions.length === 0) {
                console.log('No sauce options found, retrying in 500ms...');
                setTimeout(() => {
                    const retrySauceOptions = $('.sauce-option');
                    const retryVegetableOptions = $('.vegetable-option');
                    console.log('Retry - Found sauce options:', retrySauceOptions.length);
                    console.log('Retry - Found vegetable options:', retryVegetableOptions.length);
                    
                    if (retrySauceOptions.length > 0) {
                        console.log('Elements found on retry, testing click events');
                        testClickEvents(retrySauceOptions, retryVegetableOptions);
                    } else {
                        console.log('Still no elements found, checking DOM structure');
                        checkDOMStructure();
                    }
                }, 500);
            } else {
                console.log('Elements found, testing click events');
                testClickEvents(sauceOptions, vegetableOptions);
            }
        }, 1000);
        
        // Function to test click events
        function testClickEvents(sauceOptions, vegetableOptions) {
            sauceOptions.each(function(index) {
                const option = $(this);
                const input = option.find('input');
                const card = option.find('.sauce-card, .vegetable-card');
                console.log(`Sauce option ${index}:`, {
                    'class': option.attr('class'),
                    'input': input.length,
                    'input-type': input.attr('type'),
                    'input-name': input.attr('name'),
                    'input-value': input.val(),
                    'card': card.length,
                    'card-class': card.attr('class')
                });
            });
            
            // Test click events
            if (sauceOptions.length > 0) {
                console.log('Testing click on first sauce option');
                const firstSauce = sauceOptions.first();
                console.log('First sauce option:', firstSauce.attr('class'));
                
                // Simulate click
                firstSauce.trigger('click');
            }
        }
        
        // Function to check DOM structure
        function checkDOMStructure() {
            console.log('Checking DOM structure...');
            const container = $('#dynamicAddonsContainer');
            console.log('Container exists:', container.length > 0);
            console.log('Container HTML:', container.html());
            
            const sections = container.find('.customization-section');
            console.log('Sections in container:', sections.length);
            
            sections.each(function(index) {
                const section = $(this);
                const id = section.attr('id');
                const isVisible = section.is(':visible');
                const options = section.find('.sauce-option, .vegetable-option');
                console.log(`Section ${index + 1}: ID=${id}, Visible=${isVisible}, Options=${options.length}`);
            });
        }
    }

    // Collect customization options
    function collectCustomizationOptions() {
        let options = {
            quantity: quantity,
            productType: currentProductType,
            isMenu: isMenu,
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
                    case 'extras': return 'extras';
                    default: return cat;
                }
            }).join(', ');
            
            // Show more specific error message
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
        console.log('=== ADD TO CART BUTTON CLICKED ===');
        console.log('Current product type:', currentProductType);
        console.log('Is menu:', isMenu);
        
        if (!validateRequiredSelections()) {
            console.log('Required selections validation failed');
            return;
        }

        let customizationOptions = collectCustomizationOptions();
        console.log('Collected customization options:', customizationOptions);
        
        // Store customization options for the current product
        window.currentCustomizationOptions = customizationOptions;
        
        // Trigger add to cart (this should be handled by the parent page)
        if (typeof window.addToCartWithCustomization === 'function') {
            console.log('Calling addToCartWithCustomization function');
            window.addToCartWithCustomization(customizationOptions);
        } else {
            console.error('addToCartWithCustomization function not found!');
            console.log('Available window functions:', Object.keys(window).filter(key => key.includes('addToCart')));
            // Fallback: show success message
            if (typeof toastr !== 'undefined') {
                toastr.success('Produit ajouté au panier avec succès!');
            } else {
                alert('Produit ajouté au panier avec succès!');
            }
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
        let productType = button.data('product-type') || currentProductType;
        let productName = button.data('product-name');
        let productPrice = button.data('product-price');
        let menuType = button.data('menu-type') || false;
        let productSubType = button.data('product-sub-type') || null;
        let sectionsToShow = button.data('sections-to-show') || null;
        
        console.log('Modal data:', { productType, productName, productPrice, menuType, productSubType, sectionsToShow });
        
        // Update modal content
        $('#modalProductName').text(productName || 'Produit');
        $('#modalProductType').text(productType || 'Type');
        $('#modalProductPrice').text((productPrice || '0') + '€');
        
        // Update current product type and menu status
        currentProductType = productType;
        isMenu = menuType;
        
        // Create addon sections if global addons data is available
        if (typeof window.currentAddons !== 'undefined' && window.currentAddons) {
            console.log('Creating addon sections with data:', window.currentAddons);
            createAddonSections(window.currentAddons);
            
            // Verify sections were created
            setTimeout(() => {
                const sections = $('.customization-section');
                console.log('Total sections found after creation:', sections.length);
                sections.each(function(index) {
                    const section = $(this);
                    const id = section.attr('id');
                    const isVisible = section.is(':visible');
                    console.log(`Section ${index + 1}: ID=${id}, Visible=${isVisible}`);
                });
                
                // Force show sections if they're hidden
                if (sections.length > 0) {
                    sections.show();
                    console.log('Forced show of all sections');
                    
                    // Verify sections are now visible
                    setTimeout(() => {
                        sections.each(function(index) {
                            const section = $(this);
                            const id = section.attr('id');
                            const isVisible = section.is(':visible');
                            console.log(`Section ${index + 1} after force show: ID=${id}, Visible=${isVisible}`);
                        });
                    }, 100);
                }
            }, 100);
        
        // Show appropriate sections
        showCustomizationSections(productType, menuType, productSubType, sectionsToShow);
            
            // Final check - ensure sections are visible
            setTimeout(() => {
                const sections = $('.customization-section');
                console.log('Final visibility check after showCustomizationSections:');
                sections.each(function(index) {
                    const section = $(this);
                    const id = section.attr('id');
                    const isVisible = section.is(':visible');
                    console.log(`Final check - Section ${index + 1}: ID=${id}, Visible=${isVisible}`);
                    
                    if (!isVisible) {
                        console.log(`Final force show of section: ${id}`);
                        section.show();
                    }
                });
            }, 200);
        } else {
            console.log('No addons data available in modal');
            console.log('window.currentAddons:', window.currentAddons);
        }
        
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