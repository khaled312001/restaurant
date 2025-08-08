// This file redirects to Facebook's official fbevents.js
// If you need Facebook Pixel, use the official CDN: https://connect.facebook.net/en_US/fbevents.js

console.warn('fbevents.js: Please use Facebook\'s official CDN instead of local file');

// Optionally redirect to the official Facebook Pixel script
if (typeof window !== 'undefined') {
    const script = document.createElement('script');
    script.async = true;
    script.src = 'https://connect.facebook.net/en_US/fbevents.js';
    document.head.appendChild(script);
} 