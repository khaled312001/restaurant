<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .video-container { margin: 20px 0; }
        .video-modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 1000; }
        .video-content { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); }
        .close-btn { position: absolute; top: -40px; right: 0; color: white; font-size: 30px; cursor: pointer; }
        iframe { border: none; }
    </style>
</head>
<body>
    <h1>Video Functionality Test</h1>
    
    <div class="video-container">
        <h3>Test 1: Direct YouTube Embed</h3>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/DzSSUU37ynQ?rel=0&modestbranding=1" frameborder="0" allowfullscreen></iframe>
    </div>
    
    <div class="video-container">
        <h3>Test 2: Button with Popup</h3>
        <button onclick="openVideoPopup()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Play Video
        </button>
    </div>
    
    <div class="video-container">
        <h3>Test 3: Helper Function Test</h3>
        <p>YouTube URL: https://youtu.be/DzSSUU37ynQ</p>
        <p>Converted URL: {{ getYouTubeEmbedUrl('https://youtu.be/DzSSUU37ynQ') }}</p>
        <p>Is Local Environment: {{ isLocalEnvironment() ? 'Yes' : 'No' }}</p>
    </div>
    
    <!-- Video Modal -->
    <div id="videoModal" class="video-modal">
        <div class="video-content">
            <span class="close-btn" onclick="closeVideoPopup()">&times;</span>
            <iframe id="videoIframe" width="800" height="450" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    
    <script>
        function openVideoPopup() {
            var modal = document.getElementById('videoModal');
            var iframe = document.getElementById('videoIframe');
            iframe.src = 'https://www.youtube.com/embed/DzSSUU37ynQ?rel=0&modestbranding=1&origin=' + encodeURIComponent(window.location.origin);
            modal.style.display = 'block';
        }
        
        function closeVideoPopup() {
            var modal = document.getElementById('videoModal');
            var iframe = document.getElementById('videoIframe');
            modal.style.display = 'none';
            iframe.src = '';
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            var modal = document.getElementById('videoModal');
            if (event.target == modal) {
                closeVideoPopup();
            }
        }
        
        // Close modal with ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeVideoPopup();
            }
        });
    </script>
</body>
</html> 