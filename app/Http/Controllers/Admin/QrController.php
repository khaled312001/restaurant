<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BasicExtended;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class QrController extends Controller
{
    public function qrCode() {
        $abe = BasicExtended::first();
        $bs = \App\Models\BasicSetting::first();

        if (empty($abe->qr_image) || !file_exists(public_path('./assets/front/img/' . $abe->qr_image))) {
        	$directory = public_path('assets/front/img/');
            @mkdir($directory, 0775, true);
            $fileName = uniqid() . '.png';

            $qrCode = app('qrcode')->size(250)->errorCorrection('H')
                ->color(0, 0, 0)
                ->style('square')
                ->eye('square');
            
            // Generate QR code content
            $qrContent = $qrCode->generate(url('qr-menu'));
            
            // Save as PNG file for better image processing
            $fileName = uniqid() . '.png';
            file_put_contents($directory . $fileName, $qrContent);

            $extendeds = BasicExtended::all();
            foreach ($extendeds as $key => $extended) {
	            $extended->qr_image = $fileName;
	            $extended->save();
            }

        }

        $data['abe'] = $abe;
        $data['bs'] = $bs;

        return view('admin.qr-code', $data);
    }

    public function generate(Request $request)
    {
        $img = $request->file('image');
        $type = $request->type;

        $abe = BasicExtended::first();
        $bs = \App\Models\BasicSetting::first();

        // set default values for all params of qr image, if there is no value for a param
        $color = hex2rgb($request->color);

        $directory = public_path('assets/front/img/');
        @mkdir($directory, 0775, true);

        // remove previous qr image
        @unlink($directory . $abe->qr_image);

        // Generate QR code as PNG for image processing
        $qrcode = app('qrcode')->size($request->size)->errorCorrection('H')->margin($request->margin)
            ->color($color['red'], $color['green'], $color['blue'])
            ->style($request->style)
            ->eye($request->eye_style);

        // Generate QR code as PNG first
        $qrImage = uniqid() . '.png';
        $qrContent = $qrcode->generate(url('qr-menu'));
        
        // Save QR code as PNG
        $qrPath = $directory . $qrImage;
        file_put_contents($qrPath, $qrContent);

        // Process image overlay
        if ($type == 'image' && $request->hasFile('image')) {
            @unlink($directory . $abe->qr_inserted_image);
            $mergedImage = uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move($directory, $mergedImage);
            
            // Merge uploaded image with QR code
            $this->mergeImageWithQR($qrPath, $directory . $mergedImage, $request);
        } elseif ($type == 'default' && $bs && $bs->logo) {
            // Use current logo as default overlay
            $logoPath = public_path('assets/front/img/' . $bs->logo);
            if (file_exists($logoPath)) {
                $this->mergeImageWithQR($qrPath, $logoPath, $request);
            }
        } elseif ($type == 'default') {
            // Generate QR code without overlay if no logo exists
            // The QR code is already generated above
        }

        // Process text overlay
        if ($type == 'text' && !empty($request->text)) {
            $this->addTextToQR($qrPath, $request);
        }

        $extendeds = BasicExtended::all();
        // store the params in database
        foreach ($extendeds as $key => $extended) {
	        $extended->qr_color = $request->color;
	        $extended->qr_size = $request->size;
	        $extended->qr_style = $request->style;
	        $extended->qr_eye_style = $request->eye_style;
	        $extended->qr_image = $qrImage;
	        $extended->qr_type = $type;

	        if ($type == 'image') {
	        	if ($request->hasFile('image')) {
	            	$extended->qr_inserted_image = $mergedImage;
	        	}
	            $extended->qr_inserted_image_size = $request->image_size ?? 20;
	            $extended->qr_inserted_image_x = $request->image_x;
	            $extended->qr_inserted_image_y = $request->image_y;
	        }

	        if ($type == 'text' && !empty($request->text)) {
	            $extended->qr_text = $request->text;
	            $extended->qr_text_color = $request->text_color;
	            $extended->qr_text_size = $request->text_size;
	            $extended->qr_text_x = $request->text_x;
	            $extended->qr_text_y = $request->text_y;
	        }

	        $extended->qr_margin = $request->margin;
	        $extended->save();
        }


        return url($directory . $qrImage);
    }

    private function mergeImageWithQR($qrPath, $overlayPath, $request)
    {
        try {
            // Load QR code image
            $qrImage = Image::make($qrPath);
            
            // Load overlay image
            $overlayImage = Image::make($overlayPath);
            
            // Calculate overlay size (percentage of QR code size)
            $overlaySize = ($request->image_size ?? 20) / 100 * $qrImage->width();
            $overlayImage->resize($overlaySize, $overlaySize, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            // Calculate position (percentage of QR code dimensions)
            $x = ($request->image_x ?? 50) / 100 * ($qrImage->width() - $overlayImage->width());
            $y = ($request->image_y ?? 50) / 100 * ($qrImage->height() - $overlayImage->height());
            
            // Insert overlay image into QR code
            $qrImage->insert($overlayImage, 'top-left', $x, $y);
            
            // Save the merged image
            $qrImage->save($qrPath);
            
        } catch (\Exception $e) {
            // If image processing fails, continue without overlay
            \Log::error('QR Code image merging failed: ' . $e->getMessage());
        }
    }

    private function addTextToQR($qrPath, $request)
    {
        try {
            // Load QR code image
            $qrImage = Image::make($qrPath);
            
            // Calculate text size
            $textSize = ($request->text_size ?? 10) / 100 * $qrImage->width();
            
            // Calculate position
            $x = ($request->text_x ?? 50) / 100 * $qrImage->width();
            $y = ($request->text_y ?? 50) / 100 * $qrImage->height();
            
            // Add text to image
            $qrImage->text($request->text, $x, $y, function($font) use ($textSize, $request) {
                $font->file(public_path('assets/admin/fonts/OpenSans-Regular.ttf'));
                $font->size($textSize);
                $font->color($request->text_color ?? '#000000');
                $font->align('center');
                $font->valign('middle');
            });
            
            // Save the image with text
            $qrImage->save($qrPath);
            
        } catch (\Exception $e) {
            // If text processing fails, continue without text
            \Log::error('QR Code text addition failed: ' . $e->getMessage());
        }
    }
}
