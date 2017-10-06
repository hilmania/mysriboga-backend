<?php

namespace App\Api\V1\Controllers;

use Auth;
use JWTAuth;
use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    //
    public function getAlbum()
    {
        $serveraddr = 'http://mysriboga.sfm.co.id:8000/';

        $result = (new Gallery())->getAlbum();

        foreach( $result as $res )
            $res->url_thumbnail = $serveraddr.''.$res->url_thumbnail;

        return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
    }

    public function getGallery($idalbum)
    {
        $serveraddr = 'http://mysriboga.sfm.co.id:8000/';

        $result = (new Gallery())->getGallery($idalbum);

        foreach( $result->galeri as $res )
            $res->url_gambar = $serveraddr.''.$res->url_gambar;

        foreach( $result->galeri as $res )
            $res->url_thumbnail = $serveraddr.''.$res->url_thumbnail;

        return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
    }

    public function getPhoto($idalbum, $idphoto)
    {
    	$serveraddr = 'http://mysriboga.sfm.co.id:8000/';

        $result = (new Gallery())->getPhoto($idalbum, $idphoto);

        $result->url_gambar = $serveraddr.''.$result->url_gambar;

        return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
    }
}
