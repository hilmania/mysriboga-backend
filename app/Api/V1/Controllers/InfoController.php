<?php

namespace App\Api\V1\Controllers;

use Auth;
use JWTAuth;
use App\Info;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InfoController extends Controller
{
    public function about()
    {
        $result = (new Info())->getAbout();

        return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
    }

    public function faq()
    {
        $result = (new Info())->getFaq();

        return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
    }

    public function faqCategories()
    {
        $result = (new Info())->getFaqCategories();

        return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
    }

    public function faqQuestions($idcategory)
    {
        $result = (new Info())->getFaqQuestionsByCategory($idcategory);

        return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
    }

    public function faqAnswers($idcategory, $idquestion)
    {
        $result = (new Info())->getFaqAnswerByQuestion($idcategory, $idquestion);

        return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
    }

    public function slider()
    {
        $serveraddr = 'http://mysriboga.sfm.co.id:8000/';

        $result = (new Info())->getSliderContent();

        // dd($result);

        if ( !empty($result->recipe) ) {
        	
            if ( !empty( $result->recipe->url_gambar ) && !empty( $result->recipe->url_thumbnail ) )
                $result->recipe->url_gambar = $serveraddr.''.$result->recipe->url_gambar;
                $result->recipe->url_thumbnail = $serveraddr.''.$result->recipe->url_thumbnail;
        }
        
        if ( !empty($result->gallery) ) {

            if ( !empty( $result->gallery->url_slider ) && !empty( $result->gallery->url_thumbnail ) )
                $result->gallery->url_slider = $serveraddr.''.$result->gallery->url_slider;
                $result->gallery->url_thumbnail = $serveraddr.''.$result->gallery->url_thumbnail;
        }

        if ( !empty($result->product) ) {

            if ( !empty( $result->product->url_gambar ) && !empty( $result->product->url_thumbnail ) )
                $result->product->url_gambar = $serveraddr.''.$result->product->url_gambar;
                $result->product->url_thumbnail = $serveraddr.''.$result->product->url_thumbnail;
        }

        if ( !empty($result->news) ) {

            if ( !empty( $result->news->url_slider ) && !empty( $result->news->cover_berita ) )
                $result->news->url_slider = $serveraddr.''.$result->news->url_slider;
                $result->news->cover_berita = $serveraddr.''.$result->news->cover_berita;
        }

        return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
    }

    public function getProductCategory()
    {
        $result = \DB::table('info_produk_grup')
            ->get();

        return response()->json([
                'status' => 'OK',
                'category' => $result
            ]);  
    }

    public function getProductList()
    {
        $serveraddr = 'http://mysriboga.sfm.co.id:8000/';

        $result = (new Info())->getProductList();

        foreach( $result as $res )
            if( !empty($res->url_gambar) )
                $res->url_gambar = $serveraddr.''.$res->url_gambar;
        foreach( $result as $res )    
            if( !empty($res->url_thumbnail) )
                $res->url_thumbnail = $serveraddr.''.$res->url_thumbnail;           

        return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
    }

    public function getProductById($idproduct)
    {
        $serveraddr = 'http://mysriboga.sfm.co.id:8000/';

        $result = (new Info())->getProductById($idproduct);

        if( !empty($result->product->url_gambar))
            $result->product->url_gambar = $serveraddr.''.$result->product->url_gambar;

        if( !empty($result->resep) )
        {
	        foreach ( $result->resep as $res)
	        {
	            if( !empty($res->url_gambar))
	                $res->url_gambar = $serveraddr.''.$res->url_gambar;
	            else
	                $res->url_gambar = $serveraddr.'public/assets/images/product/default.jpg';
	        	if( !empty($res->url_thumbnail))
	        		$res->url_thumbnail = $serveraddr.''.$res->url_thumbnail;
	        	else
	        		$res->url_thumbnail = $serveraddr.'public/assets/images/product/default.jpg';
	        }
	    }

        return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);  
    }

    public function getLocationList()
    {
        $serveraddr = 'http://mysriboga.sfm.co.id:8000/';

        $result = (new Info())->getLokasiList();
        
        foreach( $result as $res )    
            if( !empty($res->url_thumbnail) )
                $res->url_thumbnail = $serveraddr.''.$res->url_thumbnail;

        return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
    }

    public function getLocationByKota($idkota)
    {
        $serveraddr = 'http://mysriboga.sfm.co.id:8000/';

        $result = (new Info())->getLokasiByKota($idkota);

        foreach( $result as $res )    
            if( !empty($res->url_thumbnail) )
                $res->url_thumbnail = $serveraddr.''.$res->url_thumbnail;

        return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
        
    }

    public function getLocationById($idkota, $idlokasi)
    {
        $serveraddr = 'http://mysriboga.sfm.co.id:8000/';

        $result = (new Info())->getLokasiById($idkota, $idlokasi);

        if( !empty($result->url_gambar))
            $result->url_gambar = $serveraddr.''.$result->url_gambar;

        return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
    }
}
