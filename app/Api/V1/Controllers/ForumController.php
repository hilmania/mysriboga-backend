<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\Forum;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForumController extends Controller
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

    public function threadsScc()
    {
        $user = $this->userAuth();

        if ( $user && $user->is_active == 1 ) {

            $threads = (new Forum())->getThreadsScc();

            return response()->json([
                    'status' => 'OK',
                    'message' => 'Threads successfully retrieved',
                    'result' => $threads
                ], 200);

        } else return response()->json([
                'status' => 'DENIED',
                'message' => 'You are not authorised to access this'
            ], 401);
    }


    public function threadsUkm()
    {
        $user = $this->userAuth();

        if ( $user && $user->is_active == 1 ) {

            $threads = (new Forum())->getThreadsUkm();

            return response()->json([
                    'status' => 'OK',
                    'message' => 'Threads successfully retrieved',
                    'result' => $threads
                ], 200);

        } else return response()->json([
                'status' => 'DENIED',
                'message' => 'You are not authorised to access this'
            ], 401);
    }

    public function getThreadScc($idthread)
    {
        $user = $this->userAuth();

        if ( $user ) {

            $thread = (new Comment())->getThreadScc($idthread);

            return response()->json([
                    'status' => 'OK',
                    'message' => 'Thread and comments successfully retrieved',
                    'result' => $thread
                ], 200);

        } else return response()->json([
                'status' => 'DENIED',
                'message' => 'You are not authorised to access this'
            ], 401);
    }

    public function getThreadUkm($idthread)
    {
        $user = $this->userAuth();

        if ( $user && $user->is_active == 1 ) {

            $thread = (new Comment())->getThreadUkm($idthread);

            return response()->json([
                    'status' => 'OK',
                    'message' => 'Thread and comments successfully retrieved',
                    'result' => $thread
                ], 200);

        } else return response()->json([
                'status' => 'DENIED',
                'message' => 'You are not authorised to access this'
            ], 401);
    }

    public function postThreadScc(Request $request)
    {
        $user = $this->userAuth();

        if ( $user ) {

            $thread = new Forum;

            $thread->id_user = $user->id;
            $thread->judul_post = $request['judul_post'];
            $thread->konten_post = $request['konten_post'];
						$thread->gambar = $request['gambar'];
            $thread->tipe_forum = 1;

            $insert = $thread->save();

            if ( $insert )

                return response()->json([
                    'status' => 'OK',
                    'message' => 'Your thread has been posted'
                ], 200);

            else

                return response()->json([
                    'status' => 'Failed',
                    'message' => 'Forbidden action',
                ], 403);

        } else return response()->json([
                'status' => 'DENIED',
                'message' => 'You are not authorised to access this'
            ], 401);
    }



    public function postThreadUkm(Request $request)
    {
        $user = $this->userAuth();

        if ( $user ) {

            $thread = new Forum;

            $thread->id_user = $user->id;
            $thread->judul_post = $request['judul_post'];
            $thread->konten_post = $request['konten_post'];
						$thread->gambar = $request['gambar'];
            $thread->tipe_forum = 2;

            $insert = $thread->save();

            if ( $insert )

                return response()->json([
                    'status' => 'OK',
                    'message' => 'Your thread has been posted'
                ], 200);

            else

                return response()->json([
                    'status' => 'Failed',
                    'message' => 'Forbidden action',
                ], 403);

        } else return response()->json([
                'status' => 'DENIED',
                'message' => 'You are not authorised to access this'
            ], 401);
    }

    public function postComment(Request $request, $idthread)
    {
    	$user = $this->userAuth();

    	if ( $user ) {

    		$comment = new Comment;

    		$comment->id_user = $user->id;
    		$comment->id_post = $idthread;
    		$comment->isi_komentar = $request['isi_komentar'];

    		$insert = $comment->save();

    		if ( $insert )

    			return response()->json([
	                'status' => 'OK',
	                'message' => 'Your comment has been posted'
	            ], 200);

    		else

	    		return response()->json([
	                'status' => 'Failed',
	                'message' => 'Forbidden action',
	            ], 403);

    	} else return response()->json([
                'status' => 'DENIED',
                'message' => 'You are not authorised to access this'
            ], 401);
    }
}
