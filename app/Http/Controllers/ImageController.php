<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
     public function upload(Request $request) {

         try {

             $rawImage = $request->image;
             $request->image = base64_decode($rawImage);

             $request->validate([

                 'image'=>'required'
             ]);

             $allowedMimes = ['image/png'];

             $pos = strpos($rawImage, ';');
             $commaPos = strpos($rawImage, ',')+1;
             $imageData = base64_decode(substr($rawImage, $commaPos));
             $fileType = explode(':', substr($rawImage, 0, $pos))[1];

             if (in_array($fileType, $allowedMimes)) {
                 $fileName = 'image_' . time() . '.png';
                 $storageDisk = Storage::disk('public');
                 $storageDisk->put($fileName, $imageData);

                 // Save the image URL also to DB.
                 $url = $storageDisk->url($fileName);
                 $user = \Auth::user();
                 $user->image = $url;
                 $user->save();

                 return response($url, 200)
                     ->header('Content-Type', 'application/json');
             }
         }
         catch (\Exception $e) {
         }
         return response('Error uploading image', 400)
             ->header('Content-Type', 'application/json');
     }
     public function show(){
         return view('upload');
     }
}
