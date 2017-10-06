<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\User;
use App\News;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'News';

            $header = 'Berita';

            // $data = Recipe::all()->sortByDesc('id');
            $data = \DB::table('berita')
                ->get();

            return view('news/index', compact('user', 'title', 'data', 'header')); 
        }

        return view('home');        
    }

    public function form(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $header = 'Berita';

            $title = 'News';

            return view('news/form', compact('user', 'title', 'header'));    
        }
        
        return view('home');
    }

    public function add(Request $request)
    {
       $user = Auth::user();

       if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            if( !empty( $request->judul_berita ) ) {

                $photo = $request->file('photo');

                $imgname = preg_replace('/\s+/', '-', $request->judul_berita).'.'.$photo->getClientOriginalExtension();

                $thmbpath = public_path('assets/images/news/thumbnail');
                $sldpath = public_path('assets/images/news/slider/');

                $thumbnail = Image::make($photo->getRealPath())->resize(200, 200);
                $thumbnail->save($thmbpath.'/'.$imgname, 80);
                $photo->move($sldpath, $imgname);

                $dbthmb = 'public/assets/images/news/thumbnail/'.$imgname;
                $dbsldr = 'public/assets/images/news/slider/'.$imgname;

                $added = (new News())->addBerita($request->judul_berita, $dbsldr, $dbthmb, $request->isi_berita, $user->id );

                $request->session()->flash('alert-success', 'Task was successful!');
               
            } 
            else $request->session()->flash('alert-danger', 'Task failed');

            $header = 'Berita';

            $title = 'News';
            
            return back();
        }

        return view('home');
    }

    public function edit(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'News';

            $header = 'Berita';

            $data = \DB::table('berita')
            ->where('id', $id)
            ->first();;
            return view('news/editNews', compact('user', 'title', 'header', 'data'));
        }

        return view('home');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $dbsldr = NULL;

            if (!empty($request->file('photo'))) {

                $photo = $request->file('photo');
                $imgname = preg_replace('/\s+/', '-', $request->judul_berita).'.'.$photo->getClientOriginalExtension();
                $sldpath = public_path('assets/images/news');
                // $photo->move($sldpath, $imgname);
                $thumbnail = Image::make($photo->getRealPath())->resize(200, 200);
                $thumbnail->save($sldpath.'/'.$imgname, 80);
                $dbsldr = 'public/assets/images/news/'.$imgname;     
            } 

            $update = News::find($request->id);

            if ( $update ) {

                $update->judul_berita = $request->judul_berita;
                $update->isi_berita = $request->isi_berita;

                if (  $dbsldr != NULL ) {
                    $update->cover_berita = $dbsldr;
                }
                    
                $update->save();
                
                $request->session()->flash('alert-success', 'Task was successful!');
            }

            else $request->session()->flash('alert-danger', 'Task failed');

            $title = 'News';

            $header = 'Berita';

            //$unit = \DB::table('berita')->get();
            return back();
        }

        return view('home');
    }

    public function delete(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delBerita = News::where('id', '=', $id)->delete();

            $request->session()->flash('alert-success', 'Berita deleted');
            // if ( $delBerita )
            //     $request->session()->flash('alert-success', 'Berita deleted');
            // else $request->session()->flash('alert-danger', 'Task failed');

        } else $request->session()->flash('alert-danger', 'Task failed');

        $title = 'News';

        $header = 'Berita';
        
        $data = News::all();

         // return view('news/index', compact('user', 'title', 'data'));
        return back();
    }
}
