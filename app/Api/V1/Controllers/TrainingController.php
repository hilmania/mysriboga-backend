<?php

namespace App\Api\V1\Controllers;

use Auth;
use JWTAuth;
use App\Training;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrainingController extends Controller
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

    public function getList()
    {
        $user = $this->userAuth();

        $user_id = $user->id;
        $tipe_user = $user->tipe_user;
        $is_active = $user->is_active;

        if( $tipe_user == 3 && $is_active == 1 ) {

            $result = (new Training())->listTrainingAll();

            return response()->json([
                'status' => 'OK',
                'list' => $result
            ]);

        } elseif ( $tipe_user == 2) {

            $result = (new Training())->listTraining($tipe_user);

            return response()->json([
                'status' => 'OK',
                'list' => $result
            ]);

        } elseif ( $tipe_user == 3 && $is_active == 0 ) {

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

    public function getRiwayat()
    {
      $user = $this->userAuth();

      $user_id = $user->id;

      $result = (new Training())->historyTraining($user_id);

      return response()->json([
          'status' => 'OK',
          'result' => $result
      ]);
    }

    public function register($training_id)
    {
        $user = $this->userAuth();

        $user_id = $user->id;
        $tipe_user = $user->tipe_user;
        $is_active = $user->is_active;

        $check = (new Training())->check($training_id, $user_id);

        if ( !empty($check) )
            return response()->json([
                'status' => 'DENIED',
                'message' => 'You have already registered for this training'
                ], 403);

        if( $tipe_user == 3 && $is_active == 1 ) {

            $result = (new Training())->register($training_id, $user_id);

            return response()->json([
                'status' => 'OK',
                'message' => 'You have registered, awaiting approval'
            ]);

        } elseif ( $tipe_user == 2) {

            $result = (new Training())->register($training_id, $user_id);

            return response()->json([
                'status' => 'OK',
                'message' => 'You have registered, awaiting approval'
            ]);

        } elseif ( $tipe_user == 3 && $is_active == 0 ) {

            return response()->json([
                    'status' => 'DENIED',
                    'message' => 'Your account has not been approved/activated'
                ], 403);

        }

        return response()->json([
                'status' => 'DENIED',
                'message' => 'You are not authorised to do this action'
            ], 401);
    }
}
