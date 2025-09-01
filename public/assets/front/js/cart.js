var pprice = 0.00;
toastr.options.closeButton = true;

function addToCart(url, variant, qty, addons) {
    let cartUrl = url;

    // button disabled & loader activate (only for modal add to cart button)
    $(".modal-cart-link").addClass('disabled');
    $(".modal-cart-link span").removeClass('d-block');
    $(".modal-cart-link span").addClass('d-none');
    $(".modal-cart-link i").removeClass('d-none');
    $(".modal-cart-link i").addClass('d-inline-block');

    $.get(cartUrl + ',,,' + qty + ',,,' + totalPrice(qty) + ',,,' + JSON.stringify(variant) + ',,,' + JSON.stringify(addons), function (res) {

        $(".request-loader").removeClass("show");

        // button enabled & loader deactivate (only for modal add to cart button)
        $(".modal-cart-link").removeClass('disabled');
        $(".modal-cart-link span").removeClass('d-none');
        $(".modal-cart-link span").addClass('d-block');
        $(".modal-cart-link i").removeClass('d-inline-block');
        $(".modal-cart-link i").addClass('d-none');

        if (res.message) {
            // Show success message
            if (typeof toastr !== 'undefined') {
                toastr["success"](res.message);
            } else {
                alert(res.message);
            }
            
            // Redirect to cart page
            if (res.redirect) {
                setTimeout(function() {
                    window.location.href = res.redirect;
                }, 1000);
            } else {
                // Update cart count if available
                updateCartCount();
            }
        } else if (res.error) {
            if (typeof toastr !== 'undefined') {
                toastr["error"](res.error);
            } else {
                alert(res.error);
            }
        }
    }).fail(function() {
        $(".request-loader").removeClass("show");
        $(".modal-cart-link").removeClass('disabled');
        $(".modal-cart-link span").removeClass('d-none');
        $(".modal-cart-link span").addClass('d-block');
        $(".modal-cart-link i").removeClass('d-inline-block');
        $(".modal-cart-link i").addClass('d-none');
        
        if (typeof toastr !== 'undefined') {
            toastr["error"]("Error adding to cart. Please try again.");
        } else {
            alert("Error adding to cart. Please try again.");
        }
    });
}

function updateCartCount() {
    // Update cart count in header if available
    if ($('.cart-count').length > 0) {
        let currentCount = parseInt($('.cart-count').text()) || 0;
        $('.cart-count').text(currentCount + 1);
    }
}

function totalPrice(qty) {
    let total = parseFloat(pprice) || 0;
    
    // Add variations price
    $("input.voptions:checked").each(function() {
        total += parseFloat($(this).data('price')) || 0;
    });
    
    // Add addons price
    $("input[name='addons']:checked").each(function() {
        total += parseFloat($(this).data('price')) || 0;
    });
    
    // Multiply by quantity
    total = total * qty;

    return total.toFixed(2);
}

(function ($) {
    "use strict";

    // ============== add to cart js start =======================//

    $(".cart-link").on('click', function (e) {
        e.preventDefault();
        let product = $(this).data('product');
        
        if (!product) {
            console.error('Product data not found');
            return;
        }
        
        let variations = [];
        let addons = [];
        
        try {
            variations = JSON.parse(product.variations || '[]');
            addons = JSON.parse(product.addons || '[]');
        } catch (e) {
            console.error('Error parsing product data:', e);
            variations = [];
            addons = [];
        }
        
        // set product current price
        pprice = parseFloat(product.current_price) || 0;

        // clear all previously loaded variations & addon input radio & checkboxes 
        $(".variation-label").addClass("d-none");
        $("#variants").html("");
        $(".addon-label").addClass("d-none");
        $("#addons").html("");

        // load variants & addons in modal if variations or addons available for this item
        if ((variations && variations.length > 0) || (addons && addons.length > 0)) {
            $("#variationModal").modal('show');
            
            // Load variations
            if (variations && variations.length > 0) {
                $(".variation-label").removeClass("d-none");
                let variantHtml = '';
                
                variations.forEach(function(variant, index) {
                    if (variant.options && Array.isArray(variant.options)) {
                        variantHtml += `<div class="form-group">
                            <label class="form-label">${variant.name || 'Option ' + (index + 1)}</label>
                            <div class="options-list">`;
                        
                        variant.options.forEach(function(option, optIndex) {
                            variantHtml += `<div class="form-check">
                                <input class="form-check-input voptions" type="radio" name="variant_${index}" 
                                       id="variant${index}_${optIndex}" value="${option.name}" 
                                       data-option="${variant.name || 'option'}" 
                                       data-name="${option.name}" 
                                       data-price="${option.price || 0}">
                                <label class="form-check-label" for="variant${index}_${optIndex}">
                                    ${option.name}
                                    ${option.price > 0 ? ' (+€' + option.price.toFixed(2) + ')' : ''}
                                </label>
                            </div>`;
                        });
                        
                        variantHtml += `</div></div>`;
                    }
                });
                
                $("#variants").html(variantHtml);
            }

            // Load addons
            if (addons && addons.length > 0) {
                $(".addon-label").removeClass("d-none");
                let addonHtml = '';
                
                addons.forEach(function(addon, index) {
                    addonHtml += `<div class="form-check d-flex justify-content-between">
                        <div>
                            <input class="form-check-input" type="checkbox" name="addons" 
                                   id="addon${index}" value="${addon.name}" 
                                   data-price="${addon.price || 0}">
                            <label class="form-check-label" for="addon${index}">
                                ${addon.name}
                            </label>
                        </div>
                        <span>
                            + €${(addon.price || 0).toFixed(2)}
                        </span>
                    </div>`;
                });
                
                $("#addons").html(addonHtml);
            }

            // set modal price
            totalPrice(1);
            $(".modal-cart-link").attr('data-product_id', product.id);

        } else {
            $(".request-loader").addClass("show");

            let $this = $(this);
            let url = $this.attr('data-href');
            let qty = $("#detailsQuantity").length > 0 ? $("#detailsQuantity").val() : 1;

            addToCart(url, "", qty, "");
        }
    });
    
    // ============== add to cart js end =======================//

    // ============== variation modal add to cart start =======================//
    $(document).on('click', '.modal-cart-link', function () {
        let $voptions = $("input.voptions:checked");
        let variant = {};
        
        for (let i = 0; i < $voptions.length; i++) {
            let $option = $voptions.eq(i);
            let optionName = $option.data('option');
            let optionValue = $option.data('name');
            let optionPrice = parseFloat($option.data('price')) || 0;
            
            variant[optionName] = {
                'name': optionValue,
                'price': optionPrice
            };
        }

        let qty = $("input[name='cart-amount']").val() || 1;
        let pid = $(this).attr('data-product_id');
        let url = mainurl + "/add-to-cart/" + pid;

        let $addons = $("input[name='addons']:checked");
        let addons = [];
        
        if ($addons.length > 0) {
            $addons.each(function () {
                let addonName = $(this).val();
                let addonPrice = parseFloat($(this).data('price')) || 0;
                addons.push({ 
                    name: addonName, 
                    price: addonPrice 
                });
            });
        }

        addons = addons.length > 0 ? addons : "";
        qty = qty.length > 0 ? parseInt(qty) : 1;

        addToCart(url, variant, qty, addons);
    });
    // ============== variation modal add to cart end =======================//

    // ============== modal quantity add / subtract =======================//
    $(document).on("click", ".modal-quantity .plus", function () {
        let $input = $(".modal-quantity input");
        let currval = parseInt($input.val()) || 1;
        let newval = currval + 1;
        $input.val(newval);
        totalPrice(newval);
    });
    
    $(document).on("click", ".modal-quantity .minus", function () {
        let $input = $(".modal-quantity input");
        let currval = parseInt($input.val()) || 1;
        let newval = currval > 1 ? currval - 1 : 1;
        $input.val(newval);
        totalPrice(newval);
    });
    
    // Update price when quantity changes
    $(document).on("input", ".modal-quantity input", function() {
        let qty = parseInt($(this).val()) || 1;
        if (qty < 1) {
            $(this).val(1);
            qty = 1;
        }
        totalPrice(qty);
    });
    
    // Update price when variations or addons change
    $(document).on("change", "input.voptions, input[name='addons']", function() {
        let qty = parseInt($(".modal-quantity input").val()) || 1;
        totalPrice(qty);
    });
    // ============== modal quantity add / subtract end =======================//

})(jQuery);

$("button.close").click(function(e){
   e.preventDefault();
   $("#variationModal").modal('hide');
})