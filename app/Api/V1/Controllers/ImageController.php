<?php

namespace App\Api\V1\Controllers;

use Auth;
use JWTAuth;
use Validator;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{

  public function userAuth()
  {
      try {

          if (! $user = JWTAuth::parseToken()->authenticate()) {
              return response()->json(['user_not_found'], 404);
          }

      } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

          return response()->json(['token_expired'], $e->getStatusCode());

      } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

          return response()->json(['token_invalid'], $e->getStatusCode());

      } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

          return response()->json(['token_absent'], $e->getStatusCode());
      }

      return $user;
  }

    public function uploadImage(Request $request)
    {

        $user = $this->userAuth();

        $validation = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validation->fails()) {
          return response()->json([
                    'status' => 'Failed',
                    'message' => 'File harus gambar',
                ], 403);
        }

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('assets/profile'), $imageName);

        $updatedUser = User::find($user->id);
        $updatedUser->url_profilepic = 'public/assets/profile/'.$imageName;
        $updatedUser->save();

        return response()->json([
                  'status' => 'OK',
                  'message' => 'Gambar berhasil diupload',
                  'path' => $imageName
              ], 200);
    }

}
