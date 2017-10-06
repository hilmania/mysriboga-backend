<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'Product';

            $header = 'Daftar Produk';

            $data = (new Product())->getProducts();

            // dd($data);

            return view('product/index', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function form(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

        	$title = 'Product';

            $header = 'Produk';

        	$group = \DB::table('info_produk_grup')->get();

        	return view('product/form', compact('user', 'title', 'group', 'header'));
        }

        return back();
    }

    public function productForm(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'Product';

            $header = 'Produk';

            $group = \DB::table('info_produk_grup')->get();

            return view('product/formkategori', compact('user', 'title', 'group', 'header'));
        }

        return back();
    }

    public function category(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'Product';

            $header = 'Kategori Produk';

            $data = \DB::table('info_produk_grup')->get();

            return view('product/category', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function editCategory(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'Product';

            $header = 'Kategori Produk';

            $category = \DB::table('info_produk_grup')->where('idgroup', $id)->first();

            return view('product/editcategory', compact('user', 'title', 'category', 'produk', 'header'));
        }

        return back();
    }

    public function updateCategory(Request $request)
    {
        $user = Auth::user();

        $header = 'Kategori Produk';
        // dd($request);

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $update = \DB::table('info_produk_grup')->where('idgroup', $request->id)->update(['nama_grup' => $request->category]);

            $request->session()->flash('alert-success', 'Berhasil diubah');

        } else $request->session()->flash('alert-danger', 'Task failed');

        return back();
    }

    public function addCategory(Request $request)
    {
        $user = Auth::user();

        $header = 'Kategori Produk';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {
            
            $add = \DB::table('info_produk_grup')->insert(['nama_grup' => $request->category]);

            if ( $add ) {

                $request->session()->flash('alert-success', 'Task was successful!');

            }

            $title = 'Product';

            return view('product/formkategori', compact('user', 'title', 'header'));
        }

        return back();
    }

    public function deleteCategory(Request $request, $id)
    {
        $user = Auth::user();

        $header = 'Kategori Produk';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delete = \DB::table('info_produk_grup')->where('idgroup', $id)->delete();

            $request->session()->flash('alert-info', 'Berhasil dihapus');

        } else $request->session()->flash('alert-danger', 'Task failed');

        return back();
    }

    public function addProduct(Request $request)
    {
        $user = Auth::user();

        $header = 'Produk';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $picture = $request->file('picture');

            $imgname = preg_replace('/\s+/', '-', $request->productname).'.'.$picture->getClientOriginalExtension();

            $thmbpath = public_path('/assets/images/product/thumbnail/');
            $sldpath = public_path('/assets/images/product/slider/');

            $thumbnail = Image::make($picture->getRealPath())->resize(200, 200);
            $thumbnail->save($thmbpath.'/'.$imgname, 80);
            $picture->move($sldpath, $imgname);

            $dbthmb = 'public/assets/images/product/thumbnail/'.$imgname;
            $dbsldr = 'public/assets/images/product/slider/'.$imgname;

        	$add = (new Product())->addProduct($user->id, $request->productname, $request->group, $request->productdesc, $dbthmb, $dbsldr);

        	if ( $add ) {

                $path = public_path('/assets/images/product/useof/');

               // foreach( $request->file() as $req ){
               //     foreach( $req as $r ){
               //         $photo = $r["photo"];
               //         $name = $photo->getClientOriginalName();
               //         $photo->move($path, $name);
               //         $url[] = 'public/assets/images/product/useof/'.$name;
               //     }
               // }
                    
        		$addcon = (new Product())->addContent($add->id, $request->content);

        		// $adduse = (new Product())->addUseOf($add->id, $request->usage, $url);
        		
        		$request->session()->flash('alert-success', 'Task was successful!');
        	} 
        	else $request->session()->flash('alert-danger', 'Task failed');

            $title = 'Product';

            $group = \DB::table('info_produk_grup')->get();

            return view('product/form', compact('user', 'title', 'group', 'header'));
        }

        return back();
    }

    public function edit(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'Product';
            $header = 'Produk';
            $data = Product::find($id);
            $group = \DB::table('info_produk_grup')->get();
            $spec = \DB::table('spec_produk')->where('id_produk', $id)->get();

            // dd($data);

            return view('product/edit', compact('user', 'title', 'group', 'data', 'spec', 'header'));
        }

        return back();
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // dd($request->file('usage'));

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $dbthmb = NULL;
            $dbsldr = NULL;

            if (!empty($request->file('picture'))) {

                $picture = $request->file('picture');

                $imgname = preg_replace('/\s+/', '-', $request->productname).'.'.$picture->getClientOriginalExtension();

                $thmbpath = public_path('/assets/images/product/thumbnail/');
                $sldpath = public_path('/assets/images/product/slider/');

                $thumbnail = Image::make($picture->getRealPath())->resize(200, 200);
                $thumbnail->save($thmbpath.'/'.$imgname, 80);
                $picture->move($sldpath, $imgname);

                $dbthmb = 'public/assets/images/product/thumbnail/'.$imgname;
                $dbsldr = 'public/assets/images/product/slider/'.$imgname;      
            }

            $update = Product::find($request->id);

            if ( $update ) {

                $update->nama_produk = $request->productname;
                $update->deskripsi_produk = $request->productdesc;
                $update->grup_produk = $request->group;

                if ( $dbthmb != NULL && $dbsldr != NULL ) {
                    $update->url_gambar = $dbsldr;
                    $update->url_thumbnail = $dbthmb;
                }
                    
                $update->save();

                if( !empty( $request->content ) )
                {
                    $deletecon = \DB::table('spec_produk')->where('id_produk', $request->id)->delete();

                    $addcon = (new Product())->addContent($request->id, $request->content);
                }

    
                if ( !empty( $request->usage ) )
                {
                    $deleteuse = \DB::table('useof_produk')->where('id_produk', $request->id)->delete();

                    $url = [];

                    if ( !empty( $request->file('usage')) ) {

                        $path = public_path('/assets/images/product/useof/');

                        foreach( $request->file() as $req ){
                            foreach( $req as $r ){
                                $photo = $r["photo"];
                                $name = $photo->getClientOriginalName();
                                $photo->move($path, $name);
                                $url[] = 'public/assets/images/product/useof/'.$name;
                            }
                        }    
                    }                   

                    $adduse = (new Product())->addUseOf($request->id, $request->usage, $url);       
                }  

                $request->session()->flash('alert-success', 'Task was successful!');

            }

            else $request->session()->flash('alert-danger', 'Task failed');

            $title = 'Product';

            $header = 'Produk';

            $group = \DB::table('info_produk_grup')->get();

            return back();

        }

        return back();
    }

    public function delete(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delspec = \DB::table('spec_produk', '=', $id)->where('id_produk', '=', $id)->delete();
            $deluseof = \DB::table('useof_produk', '=', $id)->where('id_produk', '=', $id)->delete();

            $delete = Product::where('id', '=', $id)->delete();

            if ( $delete )
                $request->session()->flash('alert-success', 'Produk deleted');
            else $request->session()->flash('alert-danger', 'Task failed');
        
            $title = 'Product';

            $header = 'Produk';

            $data = (new Product())->getProducts();

            return view('product/index', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }
}
