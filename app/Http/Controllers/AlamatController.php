<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\User;
use App\Alamat;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = Auth::user();

        $title = 'Kontak';

        $header = 'Kontak';

        // $data = Recipe::all()->sortByDesc('id');
        $data = \DB::table('alamat')
	      ->leftJoin('alamat_tipe', 'alamat.tipe', '=', 'alamat_tipe.id_tipe')
	      ->get();
	      // dd($data);

        return view('kontak/index', compact('user', 'title', 'data', 'header'));
    }

    public function form(Request $request)
    {
        $user = Auth::user();

        $header = 'Kontak';

        $title = 'Kontak';

        $tipe_alamat = \DB::table('alamat_tipe')
      		->get();

        return view('kontak/form', compact('user', 'title', 'header', 'tipe_alamat'));
    }

    public function add(Request $request)
    {
       $user = Auth::user();

       if ( $user ) {

            if( !empty( $request->nama_kantor) ) {

                $added = (new Alamat())->addAlamat($request->nama_kantor, $request->alamat_kantor, $request->no_telp, $request->fax, $request->kota, $request->tipe, $request->longitude, $request->latitude );

                $request->session()->flash('alert-success', 'Task was successful!');
               
            } 
            else $request->session()->flash('alert-danger', 'Task failed');

            $header = 'Kontak';

            $title = 'Kontak';
            
            return back();
        }  
    }

    public function edit($id)
    {
        $user = Auth::user();

        $title = 'Kontak';

        $header = 'Kontak';

        $data =  $data = \DB::table('alamat')
	      ->leftJoin('alamat_tipe', 'alamat.tipe', '=', 'alamat_tipe.id_tipe')
	      ->where('id',$id)
	      ->first();

	      // dd($data);

	     $tipe_alamat = \DB::table('alamat_tipe')
      		->get();

        return view('kontak/editKontak', compact('user', 'title', 'header', 'data', 'tipe_alamat'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if ( $user ) {

            $update = Alamat::find($request->id);

            if ( $update ) {

                $update->nama_kantor = $request->nama_kantor;
                $update->alamat_kantor = $request->alamat_kantor;
                $update->no_telp = $request->no_telp;
                $update->fax = $request->fax;
                $update->kota = $request->kota;
                $update->tipe = $request->tipe;
                $update->longitude = $request->longitude;
                $update->latitude = $request->latitude;

                $update->save();
                
                $request->session()->flash('alert-success', 'Task was successful!');
            }

            else $request->session()->flash('alert-danger', 'Task failed');

            $title = 'Kontak';

            $header = 'Kontak';

            //$unit = \DB::table('berita')->get();
            return back();
        }
    }

    public function delete(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user ) {

            $delAlamat = Alamat::where('id', '=', $id)->delete();

            $request->session()->flash('alert-success', 'Kontak deleted');
            // if ( $delBerita )
            //     $request->session()->flash('alert-success', 'Berita deleted');
            // else $request->session()->flash('alert-danger', 'Task failed');

        } else $request->session()->flash('alert-danger', 'Task failed');

        $title = 'Kontak';

        $header = 'Kontak';
        
        $data = Alamat::all();

         // return view('news/index', compact('user', 'title', 'data'));
        return back();
    }


}
