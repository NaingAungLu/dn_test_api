<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageUploadRequest;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function uploadImage(ImageUploadRequest $request)
    {
        $folder = 'products/images';

        //if (!Storage::exists($folder)) Storage::makeDirectory($folder);

        $path = Storage::putFile($folder, $request->file('image'));

        return response()->success([
            'path' => $path,
            'url' => asset($path)
        ]);
    }
}
