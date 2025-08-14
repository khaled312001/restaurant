/**
 * Image Refresh Helper for King Kebab
 * This script provides functions to refresh product images when they are updated
 */

// Function to refresh all product images on the current page
function refreshAllProductImages() {
    if (typeof window.refreshProductImages === 'function') {
        window.refreshProductImages();
    } else {
        console.log('Refresh function not available on this page');
    }
}

// Function to refresh a specific product image
function refreshProductImage(productId) {
    if (typeof window.refreshSpecificProductImage === 'function') {
        window.refreshSpecificProductImage(productId);
    } else {
        console.log('Refresh function not available on this page');
    }
}

// Function to check if images are loading properly
function checkImageStatus() {
    const images = document.querySelectorAll('img[data-product-id]');
    let status = {
        total: images.length,
        loaded: 0,
        placeholder: 0,
        error: 0
    };
    
    images.forEach(function(img) {
        if (img.classList.contains('placeholder-image')) {
            status.placeholder++;
        } else if (img.complete && img.naturalWidth > 100) {
            status.loaded++;
        } else {
            status.error++;
        }
    });
    
    console.log('Image Status:', status);
    return status;
}

// Auto-refresh images every 30 seconds (useful for admin updates)
function startAutoRefresh() {
    setInterval(function() {
        if (document.visibilityState === 'visible') {
            refreshAllProductImages();
        }
    }, 30000);
}

// Function to manually trigger image refresh (can be called from admin panel)
function triggerImageRefresh() {
    console.log('Manual image refresh triggered');
    refreshAllProductImages();
    
    // Show success message
    if (typeof showNotification === 'function') {
        showNotification('Images refreshed successfully!', 'success');
    } else {
        alert('Images refreshed successfully!');
    }
}

// Export functions for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        refreshAllProductImages,
        refreshProductImage,
        checkImageStatus,
        startAutoRefresh,
        triggerImageRefresh
    };
} 