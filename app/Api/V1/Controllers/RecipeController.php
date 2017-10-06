<?php

namespace App\Api\V1\Controllers;

use Auth;
use JWTAuth;
use App\Recipe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecipeController extends Controller
{
    public function getRecipeList()
    {
        $result = (new Recipe())->getRecipeList();

        return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
    }

    public function getRecipeByCategory($id_category)
    {
    	$serveraddr = 'http://mysriboga.sfm.co.id:8000/';
    	$result = (new Recipe())->getRecipes($id_category);

        foreach( $result as $res )
            if( !empty($res->url_gambar))
                $res->url_gambar = $serveraddr.''.$res->url_gambar;

        foreach( $result as $res )    
            if( !empty($res->url_thumbnail) )
                $res->url_thumbnail = $serveraddr.''.$res->url_thumbnail;

        return response()->json([
                'status' => 'OK',
                'result' => $result
            ], 200);
    }

    public function getRecipeById($id_recipe)
    {
        $serveraddr = 'http://mysriboga.sfm.co.id:8000/';

        $result = (new Recipe())->getRecipeById($id_recipe);

        if (!empty($result->resep->url_gambar))
            $gambar = $serveraddr.''.$result->resep->url_gambar;

        return response()->json([
                'status' => 'OK',
                'gambar' => $gambar,
                'result' => $result
            ], 200);
    }
}