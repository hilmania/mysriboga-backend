<?php

namespace App\Api\V1\Controllers;

use Auth;
use JWTAuth;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function getNews()
    {
    	$serveraddr = 'http://mysriboga.sfm.co.id:8000/';

    	$result = \DB::table('berita')->where('status_approval', 1)->get();

    	foreach( $result as $res )
            if( !empty($res->url_slider))
                $res->url_slider = $serveraddr.''.$res->url_slider;

        foreach( $result as $res )    
            if( !empty($res->cover_berita) )
                $res->cover_berita = $serveraddr.''.$res->cover_berita;

        foreach( $result as $res )
        	$strip = strip_tags($res->isi_berita);
    		$res->description = substr($strip, 0, 120).'...';

    	return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
    }

    public function getNewsById($id)
    {
    	$serveraddr = 'http://mysriboga.sfm.co.id:8000/';

    	$result = (new News())->getRecipeId($id);

        $result->berita->url_slider = $serveraddr.''.$result->berita->url_slider;

        $result->berita->cover_berita = $serveraddr.''.$result->berita->cover_berita;
       
    	$strip = strip_tags($result->berita->isi_berita);
		$result->berita->description = substr($strip, 0, 120).'...';

    	return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
    }
}
