<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Test - King Kebab</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .video-container { 
            margin: 30px 0; 
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .test-button {
            padding: 15px 30px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px 5px;
        }
        .test-button:hover {
            background: #0056b3;
        }
        .video-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .status {
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .status.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .status.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .status.info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎥 Video Functionality Test - King Kebab</h1>
        <p>Testing video popup functionality with the provided YouTube URL: <strong>https://youtu.be/DzSSUU37ynQ</strong></p>
        
        <div class="video-container">
            <h3>Test 1: Direct YouTube Embed (Reference)</h3>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/DzSSUU37ynQ?rel=0&modestbranding=1" frameborder="0" allowfullscreen></iframe>
        </div>
        
        <div class="video-container">
            <h3>Test 2: Video Popup Button (Current Implementation)</h3>
            <button class="test-button video-popup" href="https://youtu.be/DzSSUU37ynQ">
                🎬 Play Video (Popup)
            </button>
        </div>
        
        <div class="video-container">
            <h3>Test 3: Helper Function Test</h3>
            <div class="video-info">
                <p><strong>Original URL:</strong> https://youtu.be/DzSSUU37ynQ</p>
                <p><strong>Converted URL:</strong> {{ getYouTubeEmbedUrl('https://youtu.be/DzSSUU37ynQ') }}</p>
                <p><strong>Is YouTube Video:</strong> {{ isYouTubeVideo('https://youtu.be/DzSSUU37ynQ') ? 'Yes' : 'No' }}</p>
                <p><strong>Current Domain:</strong> {{ request()->getSchemeAndHttpHost() }}</p>
                <p><strong>Is Local Environment:</strong> {{ isLocalEnvironment() ? 'Yes' : 'No' }}</p>
            </div>
        </div>
        
        <div class="video-container">
            <h3>Test 4: Alternative Popup Implementation</h3>
            <button class="test-button" onclick="openCustomVideoPopup()">
                🎬 Play Video (Custom Popup)
            </button>
        </div>
        
        <div class="video-container">
            <h3>Test 5: Different URL Formats</h3>
            <button class="test-button video-popup" href="https://www.youtube.com/watch?v=DzSSUU37ynQ">
                🎬 YouTube.com Format
            </button>
            <button class="test-button video-popup" href="https://www.youtube.com/embed/DzSSUU37ynQ">
                🎬 Embed Format
            </button>
        </div>
        
        <div class="status info">
            <h4>🔧 Troubleshooting Information:</h4>
            <ul>
                <li>Make sure Magnific Popup CSS and JS are loaded</li>
                <li>Check browser console for any JavaScript errors</li>
                <li>Verify that the YouTube URL is accessible</li>
                <li>Check if there are any Content Security Policy (CSP) restrictions</li>
            </ul>
        </div>
    </div>
    
    <!-- Magnific Popup JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize Magnific Popup
            $('.video-popup').magnificPopup({
                type: 'iframe',
                iframe: {
                    patterns: {
                        youtube: {
                            index: 'youtube.com/',
                            id: function(url) {
                                var m = url.match(/[\\?&]v=([^&#]+)/);
                                if (!m) {
                                    var m = url.match(/youtu\.be\/([^\/]+)/);
                                }
                                return m ? m[1] : null;
                            },
                            src: function(url) {
                                var videoId = this.id(url);
                                var origin = window.location.origin;
                                return 'https://www.youtube.com/embed/' + videoId + '?rel=0&modestbranding=1&origin=' + encodeURIComponent(origin);
                            }
                        }
                    }
                },
                callbacks: {
                    beforeOpen: function() {
                        console.log('Opening video popup...');
                    },
                    open: function() {
                        console.log('Video popup opened successfully');
                    },
                    close: function() {
                        console.log('Video popup closed');
                    },
                    elementParse: function(item) {
                        console.log('Parsing element:', item);
                    }
                }
            });
        });
        
        function openCustomVideoPopup() {
            var videoId = 'DzSSUU37ynQ';
            var origin = window.location.origin;
            var embedUrl = 'https://www.youtube.com/embed/' + videoId + '?rel=0&modestbranding=1&origin=' + encodeURIComponent(origin);
            
            // Create modal
            var modal = document.createElement('div');
            modal.style.cssText = 'position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.9);z-index:9999;display:flex;align-items:center;justify-content:center;';
            
            var content = document.createElement('div');
            content.style.cssText = 'position:relative;max-width:90%;max-height:90%;';
            
            var iframe = document.createElement('iframe');
            iframe.src = embedUrl;
            iframe.width = '800';
            iframe.height = '450';
            iframe.style.border = 'none';
            iframe.allowFullscreen = true;
            
            var closeBtn = document.createElement('button');
            closeBtn.innerHTML = '×';
            closeBtn.style.cssText = 'position:absolute;top:-40px;right:0;background:none;border:none;color:white;font-size:30px;cursor:pointer;';
            closeBtn.onclick = function() {
                document.body.removeChild(modal);
            };
            
            content.appendChild(closeBtn);
            content.appendChild(iframe);
            modal.appendChild(content);
            document.body.appendChild(modal);
            
            // Close on outside click
            modal.onclick = function(e) {
                if (e.target === modal) {
                    document.body.removeChild(modal);
                }
            };
            
            // Close on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (document.body.contains(modal)) {
                        document.body.removeChild(modal);
                    }
                }
            });
        }
    </script>
</body>
</html> 