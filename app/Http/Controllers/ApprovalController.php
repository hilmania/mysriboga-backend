<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Mail;
use App\User;
use App\Recipe;
use App\Product;
use App\Training;
use App\News;
use Illuminate\Http\Request;

use App\Mail\verifyPelatihan;

class ApprovalController extends Controller
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
    public function user(Request $request)
    {
        $user = Auth::user();

        $header = 'Daftar Pengguna';

        if( $user ) {

            $title = 'Approval';

            $pengguna = \DB::select("SELECT u.*, n.name as submit FROM users u LEFT JOIN users n ON n.submitter = u.id");

            // dd($pengguna);

            return view('approval/user', compact('user', 'title', 'header', 'pengguna'));
        }
        
        return back();
    }

    public function recipe(Request $request)
    {
        $user = Auth::user();

        $header = 'Daftar Resep';

        if( $user->tipe_user == 4 ) {

            $title = 'Approval';

            $resep = \DB::select("SELECT u.*, m.nama_kategori, n.name as submit, o.nama_produk as prod FROM resep u 
                LEFT JOIN users n ON n.id = u.submitter 
                LEFT JOIN resep_kategori m ON m.idkat = u.kategori
                LEFT JOIN info_produk o ON o.id = u.produk");

            // dd($resep);

            return view('approval/recipe', compact('user', 'title', 'header', 'resep'));
        }
        
        return back();
    }

    public function product(Request $request)
    {
        $user = Auth::user();

        $header = 'Daftar Produk';

        if( $user->tipe_user == 4 ) {

            $title = 'Approval';

            $produk = \DB::select("SELECT u.*, n.name as submit FROM info_produk u LEFT JOIN users n ON n.id = u.submitter");

            // dd($registrasi);

            return view('approval/product', compact('user', 'title', 'header', 'produk'));
        }
        
        return back();
    }

    public function training(Request $request)
    {
        $user = Auth::user();

        $header = 'Daftar Pelatihan';

        if( $user->tipe_user == 4 ) {

            $title = 'Approval';

            // $pelatihan = \DB::table('training_list')
            //     ->leftJoin('training_type', 'training_type.idtrtype', '=', 'training_list.jenis_pelatihan')
            //     ->leftJoin('user_type', 'user_type.idusertype', '=', 'training_list.jenis_peserta')
            //     ->where('approval', 0)->get();

            $pelatihan = \DB::select("SELECT u.*, n.name as submit, m.nama_jenis as nama_jenis, o.nama_usertype as nama_usertype
                FROM training_list u LEFT JOIN users n ON n.id = u.submitter
                LEFT JOIN training_type m ON m.idtrtype = u.jenis_pelatihan
                LEFT JOIN user_type o ON o.idusertype = u.jenis_peserta
                ");

            // dd($registrasi);

            return view('approval/training', compact('user', 'title', 'header', 'pelatihan'));
        }
        
        return back();
    }

    public function album(Request $request)
    {
        $user = Auth::user();

        $header = 'Daftar Album';

        if( $user->tipe_user == 4 ) {

            $title = 'Approval';

            $album = \DB::table('galeri_album')->where('approval', 0)->get();

            $album = \DB::select("SELECT u.*, n.name as submit FROM galeri_album u LEFT JOIN users n ON n.id = u.submitter");

            // dd($registrasi);

            return view('approval/album', compact('user', 'title', 'header', 'album'));
        }
        
        return back();
    }

    public function registran(Request $request)
    {
        $user = Auth::user();

        $header = 'Daftar Pendaftar Pelatihan';

        if( $user->tipe_user == 4 ) {

            $title = 'Approval';

            $registrasi = \DB::table('training_regist')
                ->leftJoin('users', 'users.id', '=', 'training_regist.id_user')
                ->leftJoin('training_list', 'training_list.id', '=', 'training_regist.id_training')
                ->leftJoin('training_type', 'training_type.idtrtype', '=', 'training_list.jenis_pelatihan')
                ->leftJoin('user_type', 'user_type.idusertype', '=', 'users.tipe_user')
                ->get();

            // dd($registrasi);

            return view('approval/registran', compact('user', 'title', 'registrasi', 'header'));
        }
        
        return back();
    }

    public function berita(Request $request)
    {
        $user = Auth::user();

        $header = 'Daftar Berita';

        if( $user->tipe_user == 4 ) {

            $title = 'Approval';

            // $berita = \DB::table('berita')
            //     ->leftJoin('users', 'users.id', '=', 'berita.id_user_create')
            //     ->leftJoin('user_type', 'user_type.idusertype', '=', 'users.tipe_user')
            //     ->where('berita.status_approval', 0)->get();

            $berita = \DB::select("SELECT u.*, n.name as submit FROM berita u LEFT JOIN users n ON n.id = u.id_user_create");
            // dd($berita);

            return view('approval/news', compact('user', 'title', 'header', 'berita'));
        }
        
        return back();
    }

    public function detailproduk(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 4 ) {

            $title = 'Product';
            $header = 'Produk';
            $data = Product::find($id);
            $group = \DB::table('info_produk_grup')->get();
            $spec = \DB::table('spec_produk')->where('id_produk', $id)->get();
            $useof = \DB::table('useof_produk')->where('id_produk', $id)->get();

            // dd($data);

            return view('product/detail', compact('user', 'title', 'group', 'data', 'spec', 'useof', 'header'));
        }

        return back();
    }

    public function detailresep(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 4 ) {

            $title = 'Recipe';
            $header = 'Resep';
            $unit = \DB::table('resep_unit')->get();
            
            $data = \DB::table('resep')
                ->where('id', $id)
                ->first();

            $bahan = \DB::table('resep_bahan')->where('id_resep', $id)->get();
            $instruksi = \DB::table('resep_langkah')->where('id_resep', $id)->get();
            $kategori = \DB::table('resep_kategori')->get();
            $produk = \DB::table('info_produk')->get(['id as idprod', 'nama_produk']);

            // dd($produk);

            return view('recipe/detail', compact('user', 'bahan', 'instruksi', 'title', 'unit', 'data', 'produk', 'kategori', 'header'));
        }

        return back();
    }

    //approve
    public function appUser(Request $request, $iduser)
    {
        $user = Auth::user();

        $header = 'Approval';

        if( $user->tipe_user == 4 ) {

            $activate = User::find( $iduser );
            $activate->is_active = 1;

            if ($activate->save())
                $request->session()->flash('alert-success', 'Task was successful!');
            else $request->session()->flash('alert-danger', 'Task failed!');

        }

        return back();
    }

    public function appResep(Request $request, $idresep)
    {
        $user = Auth::user();

        $header = 'Approval';

        if( $user->tipe_user == 4 ) {

            $activate = Recipe::find($idresep);
            $activate->approval = 1;

            if ($activate->save())
                $request->session()->flash('alert-success', 'Task was successful!');
            else $request->session()->flash('alert-danger', 'Task failed!');

        }

        return back();
    }

    public function appProduk(Request $request, $idproduk)
    {
        $user = Auth::user();

        $header = 'Approval';

        if( $user->tipe_user == 4 ) {

            $activate = Product::find($idproduk);
            $activate->approval = 1;

            if ($activate->save())
                $request->session()->flash('alert-success', 'Task was successful!');
            else $request->session()->flash('alert-danger', 'Task failed!');

        }

        return back();
    }

    public function appAlbum(Request $request, $idalbum)
    {
        $user = Auth::user();

        $header = 'Approval';

        if( $user->tipe_user == 4 ) {

            $activate = \DB::table('galeri_album')
                ->where('id', $idalbum)
                ->update(['approval' => 1]);

            if ($activate)
                $request->session()->flash('alert-success', 'Task was successful!');
            else $request->session()->flash('alert-danger', 'Task failed!');

        }

        return back();
    }

    public function appPelatihan(Request $request, $idtraining)
    {
        $user = Auth::user();

        $header = 'Approval';

        if( $user->tipe_user == 4 ) {

            $activate = Training::find($idtraining);
            $activate->approval = 1;

            if ($activate->save())
                $request->session()->flash('alert-success', 'Task was successful!');
            else $request->session()->flash('alert-danger', 'Task failed!');

        }

        return back();
    }

    public function appRegist(Request $request, $idregist)
    {
        $user = Auth::user();

        $header = 'Approval';

        if( $user->tipe_user == 4 ) {

            $thisUser = \DB::table('training_regist')
                ->leftJoin('users', 'users.id', '=', 'training_regist.id_user')
                ->leftJoin('training_list', 'training_list.id', '=', 'training_regist.id_training')
                ->leftJoin('training_type', 'training_type.idtrtype', '=', 'training_list.jenis_pelatihan')
                ->leftJoin('user_type', 'user_type.idusertype', '=', 'users.tipe_user')
                ->where('training_regist.idreg', $idregist)->first();
               
            $this->send($thisUser);

            $activate = \DB::table('training_regist')
                ->where('idreg', $idregist)
                ->update(['approval' => 1]);

            if ($activate)
                $request->session()->flash('alert-success', 'Task was successful!');
            else $request->session()->flash('alert-danger', 'Task failed!');

        }

        return back();
    }

    public function appBerita(Request $request, $idberita)
    {
        $user = Auth::user();

        $header = 'Approval';

        if( $user->tipe_user == 4 ) {

            $activate = News::find($idberita);
            $activate->status_approval = 1;
            $activate->id_user_approval = $user->id;

            if ($activate->save())
                $request->session()->flash('alert-success', 'Task was successful!');
            else $request->session()->flash('alert-danger', 'Task failed!');


        }

        return back();
    }

    //disapprove
    public function disappUser(Request $request, $iduser)
    {
        $user = Auth::user();

        $header = 'Approval';

        if( $user->tipe_user == 4 ) {

            $activate = User::find( $iduser );
            $activate->is_active = 0;

            if ($activate->save())
                $request->session()->flash('alert-success', 'Berhasil disapprove!');
            else $request->session()->flash('alert-danger', 'Task failed!');

        }

        return back();
    }

    public function disappResep(Request $request, $idresep)
    {
        $user = Auth::user();

        $header = 'Approval';

        if( $user->tipe_user == 4 ) {

            $activate = Recipe::find($idresep);
            $activate->approval = 0;

            if ($activate->save())
                $request->session()->flash('alert-success', 'Berhasil disapprove!');
            else $request->session()->flash('alert-danger', 'Task failed!');

        }

        return back();
    }

    public function disappProduk(Request $request, $idproduk)
    {
        $user = Auth::user();

        $header = 'Approval';

        if( $user->tipe_user == 4 ) {

            $activate = Product::find($idproduk);
            $activate->approval = 0;

            if ($activate->save())
                $request->session()->flash('alert-success', 'Berhasil disapprove!');
            else $request->session()->flash('alert-danger', 'Task failed!');

        }

        return back();
    }

    public function disappAlbum(Request $request, $idalbum)
    {
        $user = Auth::user();

        $header = 'Approval';

        if( $user->tipe_user == 4 ) {

            $activate = \DB::table('galeri_album')
                ->where('id', $idalbum)
                ->update(['approval' => 0]);

            if ($activate)
                $request->session()->flash('alert-success', 'Berhasil disapprove!');
            else $request->session()->flash('alert-danger', 'Task failed!');

        }

        return back();
    }

    public function disappPelatihan(Request $request, $idtraining)
    {
        $user = Auth::user();

        $header = 'Approval';

        if( $user->tipe_user == 4 ) {

            $activate = Training::find($idtraining);
            $activate->approval = 0;

            if ($activate->save())
                $request->session()->flash('alert-success', 'Task was successful!');
            else $request->session()->flash('alert-danger', 'Task failed!');

        }

        return back();
    }

    public function disappRegist(Request $request, $idregist)
    {
        $user = Auth::user();

        $header = 'Approval';

        if( $user->tipe_user == 4 ) {

            $thisUser = \DB::table('training_regist')
                ->leftJoin('users', 'users.id', '=', 'training_regist.id_user')
                ->leftJoin('training_list', 'training_list.id', '=', 'training_regist.id_training')
                ->leftJoin('training_type', 'training_type.idtrtype', '=', 'training_list.jenis_pelatihan')
                ->leftJoin('user_type', 'user_type.idusertype', '=', 'users.tipe_user')
                ->where('training_regist.idreg', $idregist)->first();
               
            $this->send($thisUser);

            $activate = \DB::table('training_regist')
                ->where('idreg', $idregist)
                ->update(['approval' => 0]);

            if ($activate)
                $request->session()->flash('alert-success', 'Task was successful!');
            else $request->session()->flash('alert-danger', 'Task failed!');

        }

        return back();
    }

    public function disappBerita(Request $request, $idberita)
    {
        $user = Auth::user();

        $header = 'Approval';

        if( $user->tipe_user == 4 ) {

            $activate = News::find($idberita);
            $activate->status_approval = 0;
            $activate->id_user_approval = $user->id;

            if ($activate->save())
                $request->session()->flash('alert-success', 'Task was successful!');
            else $request->session()->flash('alert-danger', 'Task failed!');


        }

        return back();
    }
}
