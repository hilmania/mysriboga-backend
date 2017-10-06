<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\Recipe;
use App\Product;
use App\Training;
use Illuminate\Http\Request;

class HomeController extends Controller
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

	//dd($user);

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 || $user->tipe_user == 4 ) {

            $title = 'Main Dashboard';

            $header = 'Dashboard';

            $scc = \DB::table('users')->where('tipe_user', 2)->count();
            $ukm = \DB::table('users')->where('tipe_user', 3)
                ->where('is_active', 1)->count();

            $resep = \DB::table('resep')->where('approval', 1)->count();
            $resep2 = \DB::table('resep')->where('approval', 0)->count();

            $produk = \DB::table('info_produk')->where('approval', 1)->count();
            $produk2 = \DB::table('info_produk')->where('approval', 0)->count();

            $album = \DB::table('galeri_album')->where('approval', 1)->count();
            $album2 = \DB::table('galeri_album')->where('approval', 0)->count();

            return view('dashboard', compact('user', 'title', 'scc', 'ukm',
             'resep', 'resep2', 'produk', 'produk2',
             'album', 'album2', 'header'));
        } else {
            Auth::logout();
            Session::flush();
            return redirect('/home');
        }
    }
}
