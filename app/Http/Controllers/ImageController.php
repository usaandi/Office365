<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;

class ImageController extends Controller
{
    public function upload(Request $request, $id)
    {

        try {
            $selectedUser = User::findorFail($id);

            $rawImage = $request->image;
            $request->image = base64_decode($rawImage);

            $request->validate([

                'image' => 'required'
            ]);

            $allowedMimes = ['image/png', 'image/jpeg'];

            $pos = strpos($rawImage, ';');
            $commaPos = strpos($rawImage, ',') + 1;
            $imageData = base64_decode(substr($rawImage, $commaPos));
            $fileType = explode(':', substr($rawImage, 0, $pos))[1];

            if (in_array($fileType, $allowedMimes)) {

                $fileName = 'image_' . time() . '.png';
                $storageDisk = Storage::disk('public');
                $storageDisk->put($fileName, $imageData);

                $appPort = env('APP_PORT');
                // Save the image URL also to DB.

                $url = $storageDisk->url($fileName);
                if($appPort !== null){

                    $url =':'.$appPort.'/'.$url;

                }
                $selectedUser->image = $url;
                $selectedUser->save();




                return response($url, 200)
                    ->header('Content-Type', 'application/json');
            }
        } catch (\Exception $e) {
            return view('unauthorized.unauthorized')->with(['error' => $e->getMessage()]);
        }
        return response('Error uploading image', 400)
            ->header('Content-Type', 'application/json');
    }

    public function show()
    {
        return view('upload');
    }
}
