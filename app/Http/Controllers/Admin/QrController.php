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
            
            // Save as SVG file
            $fileName = uniqid() . '.svg';
            file_put_contents($directory . $fileName, $qrContent);

            $extendeds = BasicExtended::all();
            foreach ($extendeds as $key => $extended) {
	            $extended->qr_image = $fileName;
	            $extended->save();
            }

        }

        $data['abe'] = $abe;

        return view('admin.qr-code', $data);
    }

    public function generate(Request $request)
    {
        $img = $request->file('image');
        $type = $request->type;

        $abe = BasicExtended::first();

        // set default values for all params of qr image, if there is no value for a param
        $color = hex2rgb($request->color);

        $directory = public_path('assets/front/img/');
        @mkdir($directory, 0775, true);
        $qrImage = uniqid() . '.png';

        // remove previous qr image
        @unlink($directory . $abe->qr_image);

        // new QR code init
        $qrcode = app('qrcode')->size($request->size)->errorCorrection('H')->margin($request->margin)
            ->color($color['red'], $color['green'], $color['blue'])
            ->style($request->style)
            ->eye($request->eye_style);

        if ($type == 'image' && $request->hasFile('image')) {

            @unlink($directory . $abe->qr_inserted_image);
            $mergedImage = uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move($directory, $mergedImage);
        }



        // generating & saving the qr code in folder
        $qrContent = $qrcode->generate(url('qr-menu'));
        $qrImage = uniqid() . '.svg';
        file_put_contents($directory . $qrImage, $qrContent);
        
        // For SVG files, we can't use Image Intervention for merging
        // So we'll skip the image merging functionality for now
        // The QR code will be generated as SVG without image overlay



        // calcualte the inserted image size
        $qrSize = $request->size;


        // Note: Image merging functionality is disabled for SVG format
        // SVG files cannot be processed with Image Intervention
        // The QR code will be generated as SVG without image overlay
        if ($type == 'image') {
            // Save uploaded image if provided
            if ($request->hasFile('image')) {
                $mergedImage = uniqid() . '.' . $img->getClientOriginalExtension();
                $img->move($directory, $mergedImage);
            }
            
            // For SVG format, we skip the image merging
            // The QR code will be generated as SVG without overlay
        }



        // Note: Text overlay functionality is disabled for SVG format
        // SVG files cannot be processed with Image Intervention
        // The QR code will be generated as SVG without text overlay
        if ($type == 'text') {
            // For SVG format, we skip the text overlay
            // The QR code will be generated as SVG without text
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
}
