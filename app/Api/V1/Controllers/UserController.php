<?php

namespace App\Api\V1\Controllers;

use Auth;
use JWTAuth;
use Validator;
use DB;
use App\User;
use App\Api\V1\Controllers\HelperController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UserController extends Controller
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

    public function getCurrentUser()
    {
        $serveraddr = 'http://mysriboga.sfm.co.id:8000/';

        $user = $this->userAuth();

        // if(!empty($user->url_profilepic))
        //     $user->url_profilepic = $serveraddr.''.$user->url_profilepic;

        if(empty($user->url_profilepic))
            $user->url_profilepic = $serveraddr.'public/assets/profile/default.png';

        return response()->json([
                    'status' => 'OK',
                    'list' => $user
                ], 200);
    }

    public function getListUkm()
    {
        $user = $this->userAuth();

        $tipe_user = $user->tipe_user;
        $is_active = $user->is_active;

        if ( $tipe_user == 3 && $is_active == 1 ) {

            $result = (new User())->getListUkm($tipe_user, $is_active);

            foreach( $result as $res )
                if( empty($res->url_profilepic) )
                    $res->url_profilepic = 'http://mysriboga.sfm.co.id:8000/public/assets/profile/default.png';

            return response()->json([
                    'status' => 'OK',
                    'list' => $result
                ], 200);

        } elseif ( $tipe_user == 3 && $is_active == 0) {

            return response()->json([
                    'status' => 'DENIED',
                    'message' => 'Your account has not been approved/activated'
                ], 403);
        }

        return response()->json([
                'status' => 'DENIED',
                'message' => 'You are not authorised to access this'
            ], 401);
    }

    public function getKomunitas()
    {
        $user = $this->userAuth();

        $is_active = $user->is_active;
        $tipe_user = $user->tipe_user;

        if ( $tipe_user == 3 && $is_active == 1 ) {

            $result = (new User())->getListKomunitas();

            return response()->json([
                    'status' => 'OK',
                    'list' => $result
                ], 200);
        } else
            return response()->json([
                'status' => 'DENIED',
                'message' => 'You are not authorised to access this'
            ], 401);
    }

    public function getDropDown()
    {
        $industri = \DB::table('jenis_industri')->get();

        $usaha = \DB::table('jenis_usaha')->get();

        $kapasitas = \DB::table('kapasitas_produksi')->get();

        $kota = \DB::table('user_kota')->get();

        return response()->json([
            'status' => 'OK',
            'industri' => $industri,
            'usaha' => $usaha,
            'kapasitas' => $kapasitas,
            'kota' => $kota
        ], 200);
    }

    public function editUser(Request $request)
    {
        $currentUser = $this->userAuth();

        $user = User::find($currentUser->id);

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->no_telp = $request['no_telp'];
        $user->alamat_1 = $request['alamat_1'];
        $user->alamat_2 = $request['alamat_2'];
        $user->kota = $request['kota'];
        $user->jenis_industri = $request['jenis_industri'];
        $user->jenis_usaha = $request['jenis_usaha'];
        $user->kapasitas_prod = $request['kapasitas_prod'];
        // if($request['profilepic']!=null){
        	$user->url_profilepic = $request['url_profilepic'];
    	// }

        $update = $user->save();

        if ( $update )
            return response()->json([
                'status' => 'OK',
                'message' => 'Profil berhasil diubah'
            ], 200);
        else
            return response()->json([
                'status' => 'Gagal',
                'message' => 'Forbidden action',
            ], 403);
    }

    public function forgot(Request $request)
    {
        $credentials = $request->only(
            'email'
        );

        $validator = Validator::make($credentials, [
            'email' => 'required|email'
        ]);

        if($validator->fails()) {
          return response()->json(array(
            'status' => 'error',
            'message' => 'data belum sesuai!'),
            200
          );
        }

        $dataUser = User::where('email', $credentials['email'])->first();
        if (empty($dataUser)){
             return response()->json(array(
                 'status' => 'error',
                 'message' => 'data user dengan email tersebut tidak ada!'),
             200
             );
         } else {
              $helper = new HelperController();
              $tipe = 'reset-password';
              $helper->sendMail($credentials['email'], $tipe);

              $user = User::where('email', $credentials['email'])->first();
              return response()->json(array(
                'status' => 'OK',
                'token' => $user->remember_token,
                'message' => 'Email berisi link reset password sudah dikirim, silahkan cek email Anda'),
                200
              );
         }
    }

    public function resetForm(Request $request)
    {
        $token = $request['code'];

        // $row = User::where('remember_token', $token)->first();
        $row = User::where(DB::raw('BINARY `remember_token`'), $token)->first();

        if(empty($row)){
        // return view('errors.404');
            return response()->json(array(
                'status' => 'error',
                'message' => 'Kode verifikasi salah'
            ),200);
        }else{
        // return view('form.forgot-password',compact('token','row'));
            return response()->json(array(
                'status' => 'OK',
                'token' => $token,
                'message' => 'Kode terverifikasi'
            ),200);
        }
    }

    public function doReset(Request $request, $token)
    {
		    $newPassword = $request['password'];
        $confirmPassword = $request['confirm_password'];

        if (strcmp($newPassword, $confirmPassword)){
            $reset = User::where('remember_token', $token)
              ->select('email', 'remember_token')
              ->first();

            if(empty($reset)){
                  return response()->json(array(
                    'status' => 'error',
                    'message' => 'email tidak terdaftar!'),
                    200
                  );
            }else{
                $user=User::where('email',$reset->email)->first();

                  $user->password = $newPassword;
                  $user->remember_token = "";
                  $user->save();

                  return response()->json(array(
                      'status' => 'OK',
                      'message' => 'update password berhasil'),
                      200
                  );
            }
        }else {
          return response()->json(array(
              'status' => 'error',
              'message' => 'Password tidak sama!'),
              200
          );
        }
    }

    public function timeout(Request $request)
    {
        $token = $request['code'];

        $reset = User::where('remember_token', $token)
        ->select('email', 'remember_token')
        ->first();

        $user=User::where('email',$reset->email)->first();

        $user->remember_token = "";
        $user->save();

        return response()->json(array(
            'status' => 'OK',
            'message' => 'Silahkan ulangi lagi'),
            200
        );
    }
}
