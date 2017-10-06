<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Forum;


class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexScc(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

          $title = 'Forum ';

          $header = 'Forum SCC';
          
          $data = (new Forum())->getThreadsScc();
          // dd($data);

          return view('forum/indexScc', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function indexUkm(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

          $title = 'Forum';

          $header = 'Forum UKM';

          $data = (new Forum())->getThreadsUkm();
           // dd($data);

          return view('forum/indexUkm', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function viewCommentScc($idforum){

      	$user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

        	$title = 'Forum';

          $header = 'Forum SCC';

        	$data =   \DB::select("SELECT u.judul_post, u.id as idforum, n.name as submit , m.*  FROM forum_komentar m LEFT JOIN forum_thread u ON u.id = m.id_post LEFT JOIN users n ON n.id = m.id_user WHERE m.id_post = $idforum");

        	// \DB::table('forum_komentar')
         //             ->leftJoin('forum_thread', 'forum_thread.id', '=', 'forum_komentar.id_post')
         //             ->leftJoin('users', 'users.id', '=', 'forum_thread.id_user')
         //             ->where('id_post', $idforum)->get();

              // dd($data);
          return view('forum/commentScc', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function viewCommentUkm($idforum){

      	$user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

        	$title = 'Forum';

          $header = 'Forum UKM';

        	$data =   \DB::select("SELECT u.judul_post, u.id as idforum, n.name as submit , m.*  FROM forum_komentar m LEFT JOIN forum_thread u ON u.id = m.id_post LEFT JOIN users n ON n.id = m.id_user WHERE m.id_post = $idforum");

        	// \DB::table('forum_komentar')
         //             ->leftJoin('forum_thread', 'forum_thread.id', '=', 'forum_komentar.id_post')
         //             ->leftJoin('users', 'users.id', '=', 'forum_thread.id_user')
         //             ->where('id_post', $idforum)->get();	
             // dd($data);         

          return view('forum/commentUkm', compact('user', 'title', 'data', 'header'));
        }
        return back();
    }

    public function modalBlockSticky(Request $request)
  	{
  		
    	if ($request->ajax()){

	      $data = Forum::find($request->id);

	      return Response($data);
   	 	};
  	}


    public function deleteForumScc(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delforum = \DB::table('forum_thread')->where('id', '=', $id)->delete();
            $delcomment = \DB::table('forum_komentar')->where('id_post', '=', $id)->delete();

            $request->session()->flash('alert-success', 'Forum deleted');

        } else $request->session()->flash('alert-danger', 'Task failed');

        $title = 'Forum';

        $header = 'Forum SCC';

        $data = (new Forum())->getThreadsScc();

        return view('forum/indexScc', compact('user', 'title', 'data', 'header'));
    }

    public function deleteForumUkm(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delforum = \DB::table('forum_thread')->where('id', '=', $id)->delete();
            $delcomment = \DB::table('forum_komentar')->where('id_post', '=', $id)->delete();

            $request->session()->flash('alert-success', 'Forum deleted');
              
        } else $request->session()->flash('alert-danger', 'Task failed');

        $title = 'Forum';

        $header = 'Forum UKM';

        $data = (new Forum())->getThreadsUkm();

        return view('forum/indexUkm', compact('user', 'title', 'data', 'header'));   
    }

    public function deleteCommentScc(Request $request, $idkomentar, $idpost)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delcomment = \DB::table('forum_komentar')->where('id_komentar', '=', $idkomentar)->delete();

            $request->session()->flash('alert-success', 'Komentar deleted');
            

        }else $request->session()->flash('alert-danger', 'Task failed');

        $title = 'Forum';

        $header = 'Forum SCC';

        $data =   \DB::select("SELECT u.judul_post, u.id as idforum, n.name as submit , m.*  FROM forum_komentar m LEFT JOIN forum_thread u ON u.id = m.id_post LEFT JOIN users n ON n.id = m.id_user WHERE m.id_post = $idpost");

       // \DB::table('forum_komentar')
       //           ->leftJoin('forum_thread', 'forum_thread.id', '=', 'forum_komentar.id_post')
       //           ->leftJoin('users', 'users.id', '=', 'forum_thread.id_user')
       //           ->where('id_post', $idpost)->get();	
                 // dd($data);

        return view('forum/commentScc', compact('user', 'title', 'data', 'header'));
    }

    public function deleteCommentUkm(Request $request, $idkomentar, $idpost)
    {
         $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delcomment = \DB::table('forum_komentar')->where('id_komentar', '=', $idkomentar)->delete();

            $request->session()->flash('alert-success', 'Komentar deleted');

        } else $request->session()->flash('alert-danger', 'Task failed');

        $title = 'Forum';

        $header = 'Forum UKM';

        $data =   \DB::select("SELECT u.judul_post, u.id as idforum, n.name as submit , m.*  FROM forum_komentar m LEFT JOIN forum_thread u ON u.id = m.id_post LEFT JOIN users n ON n.id = m.id_user WHERE m.id_post = $idpost"); 


       // \DB::table('forum_komentar')
       //           ->leftJoin('forum_thread', 'forum_thread.id', '=', 'forum_komentar.id_post')
       //           ->leftJoin('users', 'users.id', '=', 'forum_thread.id_user')
       //           ->where('id_post', $idpost)->get();	
                 // dd($data);

        return view('forum/commentUkm', compact('user', 'title', 'data', 'header'));
    }

    public function blockStickyScc(Request $request)
    {
         $user = Auth::user();

        // dd($request);

        $header = 'Forum SCC';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $update = Forum::find($request->id);

            if ( $update ) {

                $update->block = $request->pilihanblock;
                $update->sticky = $request->pilihansticky;
                    
                $update->save();  
                
                $request->session()->flash('alert-success', 'Task was successful!');
            }

            else $request->session()->flash('alert-danger', 'Task failed');

            // $title = 'Forum';
            // $data = (new Forum())->getThreadsScc();
            
             // return view('forum/indexScc', compact('user', 'title', 'data'));
            return back();
        }

        return back();
    }

     public function blockStickyUkm(Request $request)
    {
         $user = Auth::user();

         // dd($request);

         $header = 'Forum UKM';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $update = Forum::find($request->id);

            if ( $update ) {

                $update->block = $request->pilihanblock;
                $update->sticky = $request->pilihansticky;
                    
                $update->save();  
                
                $request->session()->flash('alert-success', 'Task was successful!');
            }

            else $request->session()->flash('alert-danger', 'Task failed');

            // $title = 'Forum';
            // $data = (new Forum())->getThreadsUkm();
         	// dd($data);

        // return view('forum/indexUkm', compact('user', 'title', 'data'));
            return back();
        }

        return back();
    }  
}

