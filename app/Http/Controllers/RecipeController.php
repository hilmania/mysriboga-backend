<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'Recipe';

            $header = 'Daftar Resep';

            // $data = Recipe::all()->sortByDesc('id');
            $data = \DB::table('resep')
                ->leftJoin('resep_kategori', 'resep_kategori.idkat', '=', 'resep.kategori')
                ->orderBy('resep.id', 'desc')
                ->get();

            return view('recipe/index', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function form(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {
        	$title = 'Recipe';
            $header = 'Resep';
        	$unit = \DB::table('resep_unit')->get();
            $kategori = \DB::table('resep_kategori')->get();
            $produk = \DB::table('info_produk')->get(['id as idprod', 'nama_produk']);

        	return view('recipe/form', compact('user', 'title', 'unit', 'kategori', 'produk', 'header'));
        }

        return back();
    }

    public function add(Request $request)
    {
    	$user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            if( !empty( $request->recipename ) ) {

                $photo = $request->file('photo');

                $imgname = preg_replace('/\s+/', '-', $request->recipename).'.'.$photo->getClientOriginalExtension();

                $thmbpath = public_path('/assets/images/recipe/thumbnail');
                $sldpath = public_path('/assets/images/recipe/slider/');

                $thumbnail = Image::make($photo->getRealPath())->resize(200, 200);
                $thumbnail->save($thmbpath.'/'.$imgname, 80);
                $photo->move($sldpath, $imgname);

                $dbthmb = 'public/assets/images/recipe/thumbnail/'.$imgname;
                $dbsldr = 'public/assets/images/recipe/slider/'.$imgname;

                // dd($request);

                $added = (new Recipe())->addRecipe($user->id, $request->recipename, $request->category, $request->product, 
                    $request->recipedesc, $dbsldr, $dbthmb);

                if( !empty( $request->ingredient ) )
                {
                    $adding = (new Recipe())->addIngredient($added->id, $request->ingredient);

                    if ( !empty( $request->instruction ) )
                    {
                        $addinc = (new Recipe())->addInstruction($added->id, $request->instruction);

                        $request->session()->flash('alert-success', 'Task was successful!');

                    } 
                    else $request->session()->flash('alert-info', 'Task failed');
                } 
                else $request->session()->flash('alert-info', 'Task failed');
            } 
            else $request->session()->flash('alert-danger', 'Task failed');

            $title = 'Recipe';
            $header = 'Resep';
            $unit = \DB::table('resep_unit')->get();
            
            return back();
        }

        return back();
	}

    public function edit(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

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

            return view('recipe/edit', compact('user', 'bahan', 'instruksi', 'title', 'unit', 'data', 'produk', 'kategori', 'header'));
        }

        return back();
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $header = 'Resep';

        // dd($request);

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $dbthmb = NULL;
            $dbsldr = NULL;

            if (!empty($request->file('photo'))) {

                $photo = $request->file('photo');

                $imgname = preg_replace('/\s+/', '-', $request->recipename).'.'.$photo->getClientOriginalExtension();

                $thmbpath = public_path('/assets/images/recipe/thumbnail');
                $sldpath = public_path('/assets/images/recipe/slider/');

                $thumbnail = Image::make($photo->getRealPath())->resize(200, 200);
                $thumbnail->save($thmbpath.'/'.$imgname, 80);
                $photo->move($sldpath, $imgname);

                $dbthmb = 'public/assets/images/recipe/thumbnail/'.$imgname;
                $dbsldr = 'public/assets/images/recipe/slider/'.$imgname;       
            } 

            $update = Recipe::find($request->id);

            if ( $update ) {

                $update->nama_resep = $request->recipename;
                $update->deskripsi_resep = $request->recipedesc;
                $update->kategori = $request->category;
                $update->produk = $request->product;

                if ( $dbthmb != NULL && $dbsldr != NULL ) {
                    $update->url_gambar = $dbsldr;
                    $update->url_thumbnail = $dbthmb;
                }
                    
                $update->save();

                if( !empty( $request->ingredient ) )
                {
                    $deleteing = \DB::table('resep_bahan')->where('id_resep', $request->id)->delete();

                    $adding = (new Recipe())->addIngredient($request->id, $request->ingredient);
                }

    
                if ( !empty( $request->instruction ) )
                {
                    $deleteinc = \DB::table('resep_langkah')->where('id_resep', $request->id)->delete();

                    $addinc = (new Recipe())->addInstruction($request->id, $request->instruction);        
                }  
                
                $request->session()->flash('alert-success', 'Task was successful!');
            }

            else $request->session()->flash('alert-danger', 'Task failed');

            $title = 'Recipe';
            $unit = \DB::table('resep_unit')->get();
            
            return back();
        }

        return back();
    }

    public function delete(Request $request, $id)
    {
        $user = Auth::user();

        $header = 'Resep';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delbahan = \DB::table('resep_bahan')->where('id_resep', '=', $id)->delete();
            $dellangkah = \DB::table('resep_langkah')->where('id_resep', '=', $id)->delete();

            $delete = Recipe::where('id', '=', $id)->delete();

            if ( $delete )
                $request->session()->flash('alert-success', 'Resep deleted');
            else $request->session()->flash('alert-danger', 'Task failed');

            $title = 'Recipe';

            $data = Recipe::all();

            return view('recipe/index', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }
}
