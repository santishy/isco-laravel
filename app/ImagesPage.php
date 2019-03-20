<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagesPage extends Controller
{
    public function images($fileName)
    {

    	$path= storage_path('app/images/'.$fileName);
        if(!\File::exists($path)) abort(404);
        $file=\File::get($path); //leemos el archivo
        $mimeType=\File::mimeType($path);
        $response=\Response::make($file,200); //
        $response->header('Content-Type',$mimeType);
        return $response;
    }
}
