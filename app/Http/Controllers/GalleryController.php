<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'Gallery';

            $header = 'Galeri';

            $data = \DB::table('galeri_album')->get();

            return view('gallery/index', compact('user', 'title', 'header', 'data'));
        }

        return back();
    }

    public function album(Request $request, $idalbum)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'Gallery';

            $header = 'Galeri';

            $gallery = Gallery::where('album', '=', $idalbum)
                ->get();

            return view('gallery/gallery', compact('user', 'title', 'header', 'galeri', 'gallery', 'idalbum'));
        }

        return back();
    }

    public function form(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'Gallery';

            $header = 'Galeri';

        	return view('gallery/form', compact('user', 'header', 'title'));
        }

        return back();
    }

    public function addGallery(Request $request)
    {
        $user = Auth::user();

    	if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

    		$album = $request->albumname;
            $location = $request->location;
            $date = $request->albumdate;

    		$img = $request->file('thumb');
            $imgname = preg_replace('/\s+/', '-', $request->albumname).'.'.$img->getClientOriginalExtension();

            $thumbpath = public_path('/assets/images/gallery/album/thumbnail/');

            $thumbnail = Image::make($img->getRealPath())->resize(200, 200);
            $thumbnail->save($thumbpath.'/'.$imgname, 80);

            $sliderpath = public_path('/assets/images/gallery/album/slider/');
            $img->move($sliderpath, $imgname);
            
            $dbalbum = 'public/assets/images/gallery/album/slider/'.$imgname;
            $dbalbum2 = 'public/assets/images/gallery/album/thumbnail/'.$imgname;

            $add = (new Gallery())->addAlbum($user->id, $album, $date, $location, $dbalbum, $dbalbum2);

            if ( $add ) {
	            foreach ( $request->content as $req ) {
	            	$photo = $req['photo'];
	            	$picname = preg_replace('/\s+/', '-', $req['title']).'.'.$photo->getClientOriginalExtension();
	            	$thumb = Image::make($photo->getRealPath())->resize(200, 200);
                    $thmbpath = public_path('/assets/images/gallery/thumbnail/');
	            	$thumb->save($thmbpath.'/'.$picname, 80);

	            	$sldpath = public_path('/assets/images/gallery/slider/');
	            	$photo->move($sldpath, $picname);

	            	$dbpath = 'public/assets/images/gallery/';

	            	$addPics = (new Gallery())->addPictures($req['title'], $req['desc'], $dbpath.'slider/'.$picname, $dbpath.'thumbnail/'.$picname, $add->id, $date, $location);

        			$request->session()->flash('alert-success', 'Task was successful!');
	            }
	        }

            $title = "Gallery";

            $header = 'Galeri';

            return view('gallery/form', compact('user', 'title', 'header'));  
    	}

        return back();
    }

    public function edit(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {        
            $header = 'Galeri';
            $title = 'Gallery';
            $data = Gallery::find($id);

            return view('gallery/edit', compact('user', 'title', 'data', 'id', 'header'));
        }

        return back();
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        // dd($request);

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $dbpath = NULL;

            if ( !empty($request->file('photo')) ) {
                $photo = $request->file('photo');
                $picname = preg_replace('/\s+/', '-', $request->title.'.'.$photo->getClientOriginalExtension());
                $thumb = Image::make($photo->getRealPath())->resize(200, 200);

                $thmbpath = public_path('/assets/images/gallery/thumbnail/');
                $thumb->save($thmbpath.'/'.$picname, 80);

                $sldpath = public_path('/assets/images/gallery/slider/');
                $photo->move($sldpath, $picname);

                $dbpath = 'public/assets/images/gallery/';
            }

            $update = Gallery::find($request->id);

            if ( $update ) {

                $update->judul_gambar = $request->title;
                $update->deskripsi = $request->desc;
                $update->kota = $request->location;
                $update->tanggal = $request->date;

                if ( $dbpath != NULL ) {
                    $update->url_gambar = $dbpath.'slider/'.$picname;
                    $update->url_thumbnail = $dbpath.'thumbnail/'.$picname;
                }
                    
                $update->save();

                $request->session()->flash('alert-success', 'Task was successful!');

            }

            else $request->session()->flash('alert-danger', 'Task failed');

            $title = 'Gallery';
            $header = 'Galeri';

            return back();

        }

        return back();
    }

    public function delete(Request $request, $id)
    {
        $user = Auth::user();

        $header = 'Galeri';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delete = Gallery::where('id', '=', $id)->delete();

            $request->session()->flash('alert-success', 'Task was successful!');
        } 

        else $request->session()->flash('alert-danger', 'Task failed');

        return back(); 
    }

    public function editalbum(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'Gallery';
            $header = 'Galeri';
            $data = \DB::table('galeri_album')->where('id', '=', $id)->first();

            return view('gallery/editalbum', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function updatealbum(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $dbalbum = NULL;

            if ( !empty($request->file('thumb')) ) {

                $thumbnail = $request->file('thumb');

                $imgname = preg_replace('/\s+/', '-', $request->albumname).'.'.$thumbnail->getClientOriginalExtension();

                $thmbpath = public_path('/assets/images/gallery/thumbnail/');

                $thumbnail = Image::make($thumbnail->getRealPath())->resize(200, 200);
                $thumbnail->save($thmbpath.'/'.$imgname, 80);

                $dbalbum = 'public/assets/images/gallery/thumbnail/'.$imgname;

            }

            if ( $dbalbum != NULL ) {

                $update = \DB::table('galeri_album')->where('id', '=', $request->id)
                ->update(['nama_album' => $request->albumname, 'tanggal' => $request->albumdate,
                 'kota' => $request->location, 'url_thumbnail' => $dbalbum]);

            } else {

                $update = \DB::table('galeri_album')->where('id', '=', $request->id)
                ->update(['nama_album' => $request->albumname, 'tanggal' => $request->albumdate,
                 'kota' => $request->location]);

            }               

            if ( $update )
                $request->session()->flash('alert-success', 'Task was successful!');
            else $request->session()->flash('alert-danger', 'Task failed');

            $title = 'Gallery';
            $header = 'Galeri';

            return view('gallery/form', compact('user', 'title', 'header'));
        }

        return back();
    }

    public function deletealbum(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delcontent = Gallery::where('album', '=', $id)->delete();

            if ( $delcontent ) {

                $delete = \DB::table('galeri_album')->where('id', '=', $id)->delete();

                $request->session()->flash('alert-success', 'Album deleted');

            }
            else $request->session()->flash('alert-danger', 'Task failed');

            $title = 'Gallery';

            $header = 'Galeri';

            $data = (new Gallery())->getAlbum();

            return view('gallery/index', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function insert(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'Gallery';

            $header = 'Galeri';

            $data = \DB::table('galeri_album')->where('id', '=', $id)->first();

            return view('gallery/insert', compact('user', 'title', 'data', 'id', 'header'));
        }

        return back();
    }

    public function insertPhoto(Request $request)
    {
        $user = Auth::user();

        $location = $request->location;
        $date = $request->albumdate;

        $header = 'Galeri';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $thmbpath = public_path('/assets/images/gallery/thumbnail/');

            foreach ( $request->content as $req ) {
                $photo = $req['photo'];
                $picname = preg_replace('/\s+/', '-', $req['title']).'.'.$photo->getClientOriginalExtension();
                $thumb = Image::make($photo->getRealPath())->resize(200, 200);
                $thumb->save($thmbpath.'/'.$picname, 80);

                $sldpath = public_path('/assets/images/gallery/slider/');
                $photo->move($sldpath, $picname);

                $dbpath = 'public/assets/images/gallery/';

                $addPics = (new Gallery())->addPictures($req['title'], $req['desc'], $dbpath.'slider/'.$picname, $dbpath.'thumbnail/'.$picname, $request->id, $date, $location);

                $request->session()->flash('alert-success', 'Task was successful!');
            }
               
        }

        return back();
    }
}
