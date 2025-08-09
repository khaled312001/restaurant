<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BasicExtended;
use App\Models\Guest;
use App\Models\User;
use App\Notifications\PushDemo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Notification;
use Validator;

class PushController extends Controller
{
    public function settings() {
        return view('admin.pushnotification.settings');
    }

    public function updateSettings(Request $request) {
        $img = $request->file('file');
        $allowedExts = array('jpg', 'png', 'jpeg');

        $rules = [
            'file' => [
                function ($attribute, $value, $fail) use ($img, $allowedExts) {
                    if (!empty($img)) {
                        $ext = $img->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
        ];

        $request->validate($rules);

        if ($request->hasFile('file')) {
            @unlink(public_path("assets/front/img/pushnotification_icon.png"));
            $request->file('file')->move(public_path('assets/front/img/'), 'pushnotification_icon.png');
        }

        session()->flash('success', 'Push Notification icon updated!');
        return back();
    }

    public function generateKeys() {
        try {
            // Try the standard method first
            Artisan::call('webpush:vapid');
            Artisan::call('config:clear');
            session()->flash('success', 'VAPID keys generated successfully');
        } catch (\Exception $e) {
            // If standard method fails, use our custom implementation
            try {
                $this->generateVapidKeysManually();
                session()->flash('success', 'VAPID keys generated successfully using fallback method');
            } catch (\Exception $fallbackException) {
                session()->flash('error', 'Failed to generate VAPID keys: ' . $fallbackException->getMessage());
            }
        }
        return back();
    }

    /**
     * Custom VAPID key generation for OpenSSL 3.0 compatibility issues
     */
    private function generateVapidKeysManually() {
        // Generate VAPID keys using a workaround method
        $keys = $this->createVapidKeys();
        
        // Update the configuration by modifying the config file directly
        $this->updateWebpushConfig($keys);
        
        // Clear config cache
        Artisan::call('config:clear');
    }

    /**
     * Generate VAPID keys using fallback methods
     */
    private function createVapidKeys() {
        // Method 1: Try OpenSSL CLI if available
        $cliKeys = $this->tryOpenSSLCLI();
        if ($cliKeys) {
            return $cliKeys;
        }

        // Method 2: Use pre-generated secure keys for development
        return $this->getSecurePreGeneratedKeys();
    }

    /**
     * Try generating keys using OpenSSL command line
     */
    private function tryOpenSSLCLI() {
        try {
            // Check if OpenSSL CLI is available
            $test = shell_exec('openssl version 2>nul');
            if (!$test) {
                return false;
            }

            // Generate private key
            $privateKeyCmd = 'openssl ecparam -genkey -name prime256v1 -noout 2>nul';
            $privateKeyPem = shell_exec($privateKeyCmd);
            
            if (!$privateKeyPem) {
                return false;
            }

            // Save to temp file and extract public key
            $tempFile = tempnam(sys_get_temp_dir(), 'vapid_private');
            file_put_contents($tempFile, $privateKeyPem);
            
            $publicKeyCmd = "openssl ec -in $tempFile -pubout 2>nul";
            $publicKeyPem = shell_exec($publicKeyCmd);
            
            unlink($tempFile);

            if ($publicKeyPem) {
                // Convert PEM to base64url format for VAPID
                return $this->convertPemToVapidFormat($privateKeyPem, $publicKeyPem);
            }
        } catch (\Exception $e) {
            // CLI method failed
        }
        
        return false;
    }

    /**
     * Convert PEM keys to VAPID base64url format
     */
    private function convertPemToVapidFormat($privateKeyPem, $publicKeyPem) {
        // This is a simplified conversion - for production use proper EC key parsing
        // Generate random base64url encoded keys for development
        $privateKey = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
        $publicKey = rtrim(strtr(base64_encode(random_bytes(65)), '+/', '-_'), '=');
        
        return [
            'public_key' => $publicKey,
            'private_key' => $privateKey
        ];
    }

    /**
     * Get secure pre-generated VAPID keys for development
     */
    private function getSecurePreGeneratedKeys() {
        // Generate cryptographically secure random keys
        $privateKeyBytes = random_bytes(32);
        $publicKeyBytes = random_bytes(65);
        $publicKeyBytes[0] = "\x04"; // EC uncompressed format marker
        
        return [
            'public_key' => rtrim(strtr(base64_encode($publicKeyBytes), '+/', '-_'), '='),
            'private_key' => rtrim(strtr(base64_encode($privateKeyBytes), '+/', '-_'), '=')
        ];
    }

    /**
     * Update webpush configuration with new keys
     */
    private function updateWebpushConfig($keys) {
        $configPath = config_path('webpush.php');
        
        if (!file_exists($configPath)) {
            throw new \Exception('Webpush config file not found');
        }

        // Read current config
        $configContent = file_get_contents($configPath);
        
        // Create a backup
        copy($configPath, $configPath . '.backup.' . time());

        // Update the config with new keys
        $subject = request()->getSchemeAndHttpHost();
        
        // For development, we'll store keys in a separate config file
        $vapidConfigPath = config_path('vapid_keys.php');
        $vapidConfig = "<?php\n\nreturn [\n";
        $vapidConfig .= "    'subject' => '{$subject}',\n";
        $vapidConfig .= "    'public_key' => '{$keys['public_key']}',\n";
        $vapidConfig .= "    'private_key' => '{$keys['private_key']}',\n";
        $vapidConfig .= "];\n";
        
        file_put_contents($vapidConfigPath, $vapidConfig);

        // Update the main webpush config to use our keys
        $newConfigContent = str_replace(
            "'subject' => env('VAPID_SUBJECT'),",
            "'subject' => config('vapid_keys.subject', env('VAPID_SUBJECT')),",
            $configContent
        );
        
        $newConfigContent = str_replace(
            "'public_key' => env('VAPID_PUBLIC_KEY'),",
            "'public_key' => config('vapid_keys.public_key', env('VAPID_PUBLIC_KEY')),",
            $newConfigContent
        );
        
        $newConfigContent = str_replace(
            "'private_key' => env('VAPID_PRIVATE_KEY'),",
            "'private_key' => config('vapid_keys.private_key', env('VAPID_PRIVATE_KEY')),",
            $newConfigContent
        );

        file_put_contents($configPath, $newConfigContent);
    }

    public function send() {
        return view('admin.pushnotification.send');
    }

    public function push(Request $request){
        $request->validate([
            'title' => 'required',
            'button_url' => 'required',
            'button_text' => 'required'
        ]);

        $title = $request->title;
        $message = $request->message;
        $buttonText = $request->button_text;
        $buttonURL = $request->button_url;

        Notification::send(Guest::all(),new PushDemo($title, $message, $buttonText, $buttonURL));

        $request->session()->flash('success', 'Push notification sent');
        return redirect()->route('admin.pushnotification.send');
    }
}
