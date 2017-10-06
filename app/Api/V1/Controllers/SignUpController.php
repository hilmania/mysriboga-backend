<?php

namespace App\Api\V1\Controllers;

use Config;
use App\User;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\SignUpRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use DB;

class SignUpController extends Controller
{
    public function signUp(SignUpRequest $request, JWTAuth $JWTAuth)
    {
        $user = new User($request->all());
        $no_telp = $user->no_telp;

        $cek = DB::table('users')
        ->where('no_telp', $no_telp)->first();     

        if($cek!=null){
        	$myArray = array("status"=>"failed");
			return json_encode($myArray);
        }else{
        	
	        if(!$user->save()) {
	            throw new HttpException(500);
	        }

	        if($user->tipe_user == 3) {
	            $user->is_active = 0;
	        }

	        if(!Config::get('boilerplate.sign_up.release_token')) {
	            return response()->json([
	                'status' => 'ok'
	            ], 201);
	        }

	        $token = $JWTAuth->fromUser($user);
	        return response()->json([
	            'status' => 'ok',
	            'token' => $token
	        ], 201);
    	}
    }
}