<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    //Kota Registrasi Pengguna
    public function kotauser(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = "General";

            $header = 'Kota User';

            $data = \DB::table('user_kota')->get();

            return view('general/kotauser', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function deletekotauser(Request $request, $id)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delete = \DB::table('user_kota')->where('id', $id)->delete();
            $request->session()->flash('alert-success', 'Berhasil dihapus');

            return back();
        }

        return back();
    }

    public function formkotauser(Request $request)
    {
        $user = Auth::user();

        $title = 'General';

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            return view('general/formkotauser', compact('user', 'title', 'header'));
        }

        return back();
    }

    public function addkotauser(Request $request)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $add = \DB::table('user_kota')->insert(['kota' => $request->kota]);

            $request->session()->flash('alert-success', 'Berhasil ditambahkan');

            return back();
        }

        return back();
    }

    public function editkotauser(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'General';

            $header = 'General Settings';
            
            $data = \DB::table('user_kota')->where('id', $id)->first();

            return view('general/editkotauser', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function updatekotauser(Request $request)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            // dd($request);

            $update = \DB::table('user_kota')->where('id', $request->id)->update(['kota' => $request->kota]);

            $request->session()->flash('alert-success', 'Berhasil diubah');

            return back();
        }

        return back();
    }

    //Kota Where to Buy
    public function kotabuy(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = "General";

            $header = 'Kota Where to Buy';

            $data = \DB::table('info_lokasi')->get();

            return view('general/kotabuy', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function deletekotabuy(Request $request, $id)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delete = \DB::table('info_lokasi')->where('id', $id)->delete();
            $request->session()->flash('alert-success', 'Berhasil dihapus');

            return back();
        }

        return back();
    }

    public function formkotabuy(Request $request)
    {
        $user = Auth::user();

        $title = 'General';

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            return view('general/formkotabuy', compact('user', 'title', 'header'));
        }

        return back();
    }

    public function addkotabuy(Request $request)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $img = $request->file('thumbnail');
            $imgname = preg_replace('/\s+/', '-', $request->kota).'.'.$img->getClientOriginalExtension();

            $thmbpath = public_path('/assets/images/location/thumbnail/');
            $sldpath = public_path('/assets/images/location/main/');

            $thumbnail = Image::make($img->getRealPath())->resize(200, 200);
            $thumbnail->save($thmbpath.'/'.$imgname, 80);

            $dbthmb = 'public/assets/images/location/thumbnail/'.$imgname;
            $sldthmb = 'public/assets/images/location/main/'.$imgname;

            $img->move($sldpath, $imgname);

            $add = \DB::table('info_lokasi')->insert(['kota' => $request->kota, 'nama_lokasi' => $request->lokasi, 'alamat' => $request->alamat, 'latitude' => $request->latitude, 'longitude' => $request->longitude, 'url_gambar' => $sldthmb, 'url_thumbnail' => $dbthmb]);

            $request->session()->flash('alert-success', 'Berhasil ditambahkan');

            return back();
        }

        return back();
    }

    public function editkotabuy(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'General';

            $header = 'General Settings';
            
            $data = \DB::table('info_lokasi')->where('id', $id)->first();

            return view('general/editkotabuy', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function updatekotabuy(Request $request)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            // dd($request);

            $update = \DB::table('info_lokasi')->where('id', $request->id)->update(['kota' => $request->kota, 'nama_lokasi' => $request->lokasi, 'alamat' => $request->alamat, 'latitude' => $request->latitude, 'longitude' => $request->longitude]);

            $request->session()->flash('alert-success', 'Berhasil diubah');

            return back();
        }

        return back();
    }

	//Kategori FAQ
	public function katfaq(Request $request)
    {
    	$user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = "General";

            $header = 'Kategori FAQ';

            $data = \DB::table('faq_kategori')->get();

            return view('general/katfaq', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function deletekatfaq(Request $request, $id)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delete = \DB::table('faq_kategori')->where('idfaq_kategori', $id)->delete();
            $request->session()->flash('alert-success', 'Berhasil dihapus');

            return back();
        }

        return back();
    }

    public function formkatfaq(Request $request)
    {
        $user = Auth::user();

        $title = 'General';

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            return view('general/formkatfaq', compact('user', 'title', 'header'));
        }

        return back();
    }

    public function addkatfaq(Request $request)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $add = \DB::table('faq_kategori')->insert(['nama_kategori' => $request->kategori]);

            $request->session()->flash('alert-success', 'Berhasil ditambahkan');

            return back();
        }

        return back();
    }

    public function editkatfaq(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'General';

            $header = 'General Settings';
            
            $data = \DB::table('faq_kategori')->where('idfaq_kategori', $id)->first();

            return view('general/editkatfaq', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function updatekatfaq(Request $request)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            // dd($request);

            $update = \DB::table('faq_kategori')->where('idfaq_kategori', $request->id)->update(['nama_kategori' => $request->kategori]);

            $request->session()->flash('alert-success', 'Berhasil diubah');

            return back();
        }

        return back();
    }

	//Kategori Resep
	public function katresep(Request $request)
    {
    	$user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = "General";

            $header = 'Kategori Resep';

            $data = \DB::table('resep_kategori')->get();

            return view('general/katresep', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function deletekatresep(Request $request, $id)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delete = \DB::table('resep_kategori')->where('idkat', $id)->delete();
            $request->session()->flash('alert-success', 'Berhasil dihapus');

            return back();
        }

        return back();
    }

    public function formkatresep(Request $request)
    {
        $user = Auth::user();

        $title = 'General';

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            return view('general/formkatresep', compact('user', 'title', 'header'));
        }

        return back();
    }

    public function addkatresep(Request $request)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $add = \DB::table('resep_kategori')->insert(['nama_kategori' => $request->kategori]);

            $request->session()->flash('alert-success', 'Berhasil ditambahkan');

            return back();
        }

        return back();
    }

    public function editkatresep(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'General';
            
            $header = 'General Settings';

            $data = \DB::table('resep_kategori')->where('idkat', $id)->first();

            return view('general/editkatresep', compact('user', 'title', 'data', 'header'));

        }

        return back();
    }

    public function updatekatresep(Request $request)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            // dd($request);

            $update = \DB::table('resep_kategori')->where('idkat', $request->id)->update(['nama_kategori' => $request->kategori]);

            $request->session()->flash('alert-success', 'Berhasil diubah');

            return back();
        }

        return back();
    }

    //Jenis Usaha
    public function usaha(Request $request)
    {
    	$user = Auth::user();

        $header = 'Jenis Usaha';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = "General";

            $data = \DB::table('jenis_usaha')->get();

            return view('general/usaha', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function deleteusaha(Request $request, $id)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delete = \DB::table('jenis_usaha')->where('id', $id)->delete();
            $request->session()->flash('alert-success', 'Berhasil dihapus');

            return back();
        }

        return back();
    }

    public function formusaha(Request $request)
    {
        $user = Auth::user();

        $title = 'General';

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            return view('general/formusaha', compact('user', 'title', 'header'));
        }

        return back();
    }

    public function addusaha(Request $request)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $add = \DB::table('jenis_usaha')->insert(['usaha' => $request->usaha]);

            $request->session()->flash('alert-success', 'Berhasil ditambahkan');

            return back();
        }

        return back();
    }

    public function editusaha(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $header = 'General Settings';

            $title = 'General';
            
            $data = \DB::table('jenis_usaha')->where('id', $id)->first();

            return view('general/editusaha', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function updateusaha(Request $request)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            // dd($request);

            $update = \DB::table('jenis_usaha')->where('id', $request->id)->update(['usaha' => $request->usaha]);

            $request->session()->flash('alert-success', 'Berhasil diubah');

            return back();
        }

        return back();
    }

    // //Jenis Industri
    public function industri(Request $request)
    {
        $user = Auth::user();

        $header = 'Jenis Industri';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = "General";

            $data = \DB::table('jenis_industri')->get();

            return view('general/industri', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function deleteindustri(Request $request, $id)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delete = \DB::table('jenis_industri')->where('id', $id)->delete();
            $request->session()->flash('alert-success', 'Berhasil dihapus');

            return back();
        }

        return back();
    }

    public function formindustri(Request $request)
    {
        $user = Auth::user();

        $title = 'General';

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            return view('general/formindustri', compact('user', 'title', 'header'));
        }

        return back();
    }

    public function addindustri(Request $request)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $add = \DB::table('jenis_industri')->insert(['nama_industri' => $request->industri]);

            $request->session()->flash('alert-success', 'Berhasil ditambahkan');

            return back();
        }

        return back();
    }

    public function editindustri(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $header = 'General Settings';

            $title = 'General';
            
            $data = \DB::table('jenis_industri')->where('id', $id)->first();

            return view('general/editindustri', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function updateindustri(Request $request)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            // dd($request);

            $update = \DB::table('jenis_industri')->where('id', $request->id)->update(['nama_industri' => $request->industri]);

            $request->session()->flash('alert-success', 'Berhasil diubah');

            return back();
        }

        return back();
    }

    //Kapasitas Produksi
    public function kapasitas(Request $request)
    {
        $user = Auth::user();

        $header = 'Kapasitas Produksi';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = "General";

            $data = \DB::table('kapasitas_produksi')->get();

            return view('general/kapasitas', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function deletekapasitas(Request $request, $id)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user ) {

            $delete = \DB::table('kapasitas_produksi')->where('id', $id)->delete();
            $request->session()->flash('alert-success', 'Berhasil dihapus');

            return back();
        }

        return back();
    }

    public function formkapasitas(Request $request)
    {
        $user = Auth::user();

        $title = 'General';

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            return view('general/formkapasitas', compact('user', 'title', 'header'));
        }

        return back();
    }

    public function addkapasitas(Request $request)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $add = \DB::table('kapasitas_produksi')->insert(['range_kuantitas' => $request->kapasitas]);

            $request->session()->flash('alert-success', 'Berhasil ditambahkan');

            return back();
        }

        return back();
    }

    public function editkapasitas(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'General';

            $header = 'General Settings';
            
            $data = \DB::table('kapasitas_produksi')->where('id', $id)->first();

            return view('general/editkapasitas', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function updatekapasitas(Request $request)
    {
        $user = Auth::user();

        $header = 'General Settings';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            // dd($request);

            $update = \DB::table('kapasitas_produksi')->where('id', $request->id)->update(['range_kuantitas' => $request->kapasitas]);

            $request->session()->flash('alert-success', 'Berhasil diubah');

            return back();
        }

        return back();
    }
}
