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
.drink-option input[type="radio"]:checked + .drink-card,
.sauce-option input[type="checkbox"]:checked + .sauce-card {
    background: linear-gradient(135deg, #f39c12, #e67e22) !important;
    border-color: #d68910 !important;
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(243, 156, 18, 0.3);
}

/* Ensure text remains readable when selected */
.meat-option input[type="radio"]:checked + .meat-card .meat-text,
.vegetable-option input[type="checkbox"]:checked + .vegetable-card .vegetable-text,
.drink-option input[type="radio"]:checked + .drink-card .drink-text,
.sauce-option input[type="checkbox"]:checked + .sauce-card .sauce-text {
    color: #ffffff !important;
    font-weight: 700 !important;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

/* Hover effects */
.meat-card:hover,
.vegetable-card:hover,
.drink-card:hover,
.sauce-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    border-color: #f39c12;
}

/* Quantity button hover effects */
#decreaseQuantity:hover {
    background: #c0392b !important;
    transform: scale(1.1);
}

#increaseQuantity:hover {
    background: #229954 !important;
    transform: scale(1.1);
}

/* Modal animations */
.modal.fade .modal-dialog {
    transition: transform 0.3s ease-out;
}

.modal.show .modal-dialog {
    transform: none;
}
</style>

<script>
// Global variables to store product information
let currentProductId = null;
let currentProductName = null;
let currentProductPrice = null;
let currentProductType = null;
let currentHasMeatChoice = false;
let currentIsMenu = false;
let currentQuantity = 1;

// Function to open the customization modal
function openCustomizationModal(productId, productName, price, type, hasMeatChoice, isMenu) {
    // Store current product information
    currentProductId = productId;
    currentProductName = productName;
    currentProductPrice = price;
    currentProductType = type;
    currentHasMeatChoice = hasMeatChoice;
    currentIsMenu = isMenu;
    currentQuantity = 1;
    
    // Update modal content
    document.getElementById('modalProductName').textContent = productName;
    document.getElementById('modalProductType').textContent = type;
    document.getElementById('modalProductPrice').textContent = price + '€';
    document.getElementById('quantityDisplay').textContent = '1';
    
    // Reset all form inputs
    resetModalForm();
    
    // Show/hide sections based on product type and options
    showCustomizationSections();
    
    // Show the modal
    $('#customizationModal').modal('show');
}

// Function to show/hide customization sections based on product type
function showCustomizationSections() {
    // Show all dynamic addon sections
    const addonSections = document.querySelectorAll('[id$="Section"]');
    addonSections.forEach(section => {
        section.style.display = 'block';
    });
}

// Function to reset the modal form
function resetModalForm() {
    // Reset meat choice
    const meatInputs = document.querySelectorAll('input[name="meatChoice"]');
    meatInputs.forEach(input => input.checked = false);
    
    // Reset vegetables
    const vegetableInputs = document.querySelectorAll('input[name="vegetables"]');
    vegetableInputs.forEach(input => input.checked = false);
    
    // Reset drinks
    const drinkInputs = document.querySelectorAll('input[name="drinkChoice"]');
    drinkInputs.forEach(input => input.checked = false);
    
    // Reset sauces
    const sauceInputs = document.querySelectorAll('input[name="sauces"]');
    sauceInputs.forEach(input => input.checked = false);
    
    // Reset extras
    const extraInputs = document.querySelectorAll('input[name="extras"]');
    extraInputs.forEach(input => input.checked = false);
    
    // Reset quantity
    currentQuantity = 1;
    document.getElementById('quantityDisplay').textContent = '1';
}

// Quantity controls
document.getElementById('decreaseQuantity').addEventListener('click', function() {
    if (currentQuantity > 1) {
        currentQuantity--;
        document.getElementById('quantityDisplay').textContent = currentQuantity;
    }
});

document.getElementById('increaseQuantity').addEventListener('click', function() {
    if (currentQuantity < 10) {
        currentQuantity++;
        document.getElementById('quantityDisplay').textContent = currentQuantity;
    }
});

// Add to cart button functionality
document.getElementById('addToCartBtn').addEventListener('click', function() {
    // Collect all selected options
    const customization = collectCustomizationOptions();
    
    // Add to cart with customization
    addToCartWithCustomization(customization);
});

// Function to collect all customization options
function collectCustomizationOptions() {
    const customization = {
        productId: currentProductId,
        productName: currentProductName,
        price: currentProductPrice,
        type: currentProductType,
        quantity: currentQuantity,
        meatChoice: null,
        vegetables: [],
        drinkChoice: null,
        sauces: [],
        extras: []
    };
    
    // Get meat choice
    const selectedMeat = document.querySelector('input[name="meatChoice"]:checked');
    if (selectedMeat) {
        customization.meatChoice = selectedMeat.value;
    }
    
    // Get vegetables
    const selectedVegetables = document.querySelectorAll('input[name="vegetables"]:checked');
    selectedVegetables.forEach(input => {
        customization.vegetables.push(input.value);
    });
    
    // Get drink choice
    const selectedDrink = document.querySelector('input[name="drinkChoice"]:checked');
    if (selectedDrink) {
        customization.drinkChoice = selectedDrink.value;
    }
    
    // Get sauces
    const selectedSauces = document.querySelectorAll('input[name="sauces"]:checked');
    selectedSauces.forEach(input => {
        customization.sauces.push(input.value);
    });
    
    // Get extras
    const selectedExtras = document.querySelectorAll('input[name="extras"]:checked');
    selectedExtras.forEach(input => {
        customization.extras.push(input.value);
    });
    
    return customization;
}

// Function to add item to cart with customization
function addToCartWithCustomization(customization) {
    // Debug: Log the customization object
    console.log('Customization object:', customization);
    
    // Validate required selections based on product type
    if (currentHasMeatChoice && !customization.meatChoice) {
        alert('Veuillez choisir votre viande');
        return;
    }
    
    if (currentProductType !== 'Assiette' && customization.vegetables.length === 0) {
        alert('Veuillez choisir au moins une option de légumes');
        return;
    }
    
    if (customization.sauces.length === 0) {
        alert('Veuillez choisir au moins une sauce');
        return;
    }
    
    if (currentIsMenu && !customization.drinkChoice) {
        alert('Veuillez choisir votre boisson');
        return;
    }
    
    // Close the modal first
    $('#customizationModal').modal('hide');
    
    // Create form data
    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('customizations', JSON.stringify(customization));
    formData.append('quantity', customization.quantity);
    
    // Debug: Log the form data being sent
    console.log('Form data being sent:');
    console.log('_token:', '{{ csrf_token() }}');
    console.log('customizations:', JSON.stringify(customization));
    console.log('quantity:', customization.quantity);
    
    // Send AJAX request
    fetch('{{ route("add.cart", "") }}/' + customization.productId, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success && data.redirect) {
            // Redirect to cart page
            window.location.href = data.redirect;
        } else {
            // Fallback redirect
            window.location.href = '{{ route("front.cart") }}';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Fallback redirect on error
        window.location.href = '{{ route("front.cart") }}';
    });
}

// Initialize the modal when the page loads
document.addEventListener('DOMContentLoaded', function() {
    // Any additional initialization can go here
    console.log('Customization modal initialized');
});
</script> 