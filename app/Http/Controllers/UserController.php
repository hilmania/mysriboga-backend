<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
    		$title = 'Users';
            $header = 'Daftar Pengguna';
    		$data = (new User())->getAllUsersList();

    		return view('user/index', compact('user', 'title', 'data', 'header'));
    	}
    	
    	return back();
    }

    public function form(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 ) {
            $title = 'Users';

            $header = 'Pengguna';

            $usaha = \DB::table('jenis_usaha')
                ->get();

            $komunitas = \DB::table('komunitas')
                ->get();

            $industri = \DB::table('jenis_industri')
                ->get();

            $kapasitas = \DB::table('kapasitas_produksi')
                ->get();

            return view('user/form', compact('user', 'title', 'komunitas', 'industri', 'kapasitas', 'usaha', 'header'));
        }

        return back();
    }

    public function add(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 ) {

            $title = 'Users';

            $header = 'Pengguna';

            if ( md5($request->pass) == md5($request->repass) ) {
                
                $add = (new User())->add($user->id, $request->nama, $request->telepon, $request->pass, $request->email, $request->usertype, 
                    $request->usaha, $request->date, $request->kota, $request->alamat1, $request->alamat2, 
                    $request->komunitas, $request->contact, $request->industri, $request->kapasitas, NULL);

                // dd($add);

                if ( $add )

                    $request->session()->flash('alert-success', 'Task was successful!');

                else $request->session()->flash('alert-info', 'Task failed');
            }

            else $request->session()->flash('alert-info', 'Password tidak sesuai');
            
            $title = 'Users';
            
            return back();
        }

        return back();
    }

    public function edit($id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 ) {

            $title = 'Users';

            $header = 'Pengguna';

            $data = User::find($id);

            $komunitas = \DB::table('komunitas')
                ->get();

            return view('user/edit', compact('user', 'title', 'data', 'komunitas', 'header'));
        }

        return back();
    }

    public function profile(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1) {

        	$title = 'Profile';

            $header = 'Pengguna';

	        $data = User::find($user->id);

	        return view('user/profile', compact('user', 'title', 'data', 'header'));	
        }

        return back();

    }

    public function upprofile(Request $request)
    {
        $user = Auth::user();

        $header = 'Pengguna';

        if ( $user ) {
    
            $update = User::find($request->id);

            if ( $update ) {

                $update->name = $request->nama;
                $update->no_telp = $request->telepon;
                $update->email = $request->email;
                $update->tgl_lahir = $request->date;
                $update->alamat_1 = $request->alamat1;
                $update->alamat_2 = $request->alamat2;
                $update->kota = $request->kota;
                
                $update->save();

                $request->session()->flash('alert-success', 'Task was successful!');
            }
            else $request->session()->flash('alert-info', 'Task failed');

            return back();
        }

        return back();
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $header = 'Pengguna';

        if ( $user ) {
    
            $update = User::find($request->id);

            if ( $update ) {

                $update->name = $request->nama;
                $update->no_telp = $request->telepon;
                $update->email = $request->email;
                $update->tipe_user = $request->usertype;
                $update->jenis_usaha = $request->usaha;
                $update->tgl_lahir = $request->date;
                $update->alamat_1 = $request->alamat1;
                $update->alamat_2 = $request->alamat2;
                $update->kota = $request->kota;
                $update->ukm_contact_person = $request->contact;
                $update->jenis_industri = $request->industri;
                $update->kapasitas_prod = $request->kapasitas;
                $update->idkomunitas = $request->komunitas;

                $update->save();

                $request->session()->flash('alert-success', 'Task was successful!');
            }
            else $request->session()->flash('alert-info', 'Task failed');

            $title = 'Users';
            $komunitas = \DB::table('komunitas')
                ->get();

            return back();
        }

        return back();
    }

    public function changepass(Request $request, $id)
    {
        $user = Auth::user();
        $title = 'Users';
        $header = 'Pengguna';

        $data = User::find($id);

        return view('user/changepass', compact('user', 'title', 'data', 'header'));
    }

    public function changeuserpass(Request $request)
    {
        $user = Auth::user();
        $title = 'Users';
        $header = 'Pengguna';

        $data = User::find($user->id);

        return view('user/changepass', compact('user', 'title', 'data', 'header'));
    }

    public function updatepass(Request $request)
    {
        $user = Auth::user();

        $header = 'Pengguna';

        if ( $user ) {

            $data = User::find($request->id);

            // dd(bcrypt($request->oldpass));

            if ( $request->pass == $request->repass ) {

                $update = User::where('id', '=', $request->id)->update(['password' => bcrypt($request->pass)]);

                $request->session()->flash('alert-success', 'Password berhasil diubah!');

            } else $request->session()->flash('alert-danger', 'Password baru tidak sesuai');

            $title = 'Users';

            return back();
        }

        return back();
    }

    public function delete(Request $request, $id)
    {
        $user = Auth::user();

        $header = 'Pengguna';

        if ( $user->tipe_user == 0 ) {
            $delete = User::where('id', '=', $id)->delete();

            if ( $delete )
                $request->session()->flash('alert-success', 'User deleted');
            else $request->session()->flash('alert-danger', 'Task failed');
        } 

        $title = 'Users';
        $data = (new User())->getAllUsersList();

        return view('user/index', compact('user', 'title', 'data', 'header'));
    }

    public function community()
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'Komunitas';

            $header = 'Pengguna';

            $data = \DB::table('komunitas')->get();

            return view('user/community', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function formCommunity()
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 ) {

            $title = 'Komunitas';

            $header = 'Pengguna';

            return view('user/formcomm', compact('user', 'title', 'header'));
        }

        return back();
    }

    public function addCommunity(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 ) {

            $title = 'Komunitas';

            $header = 'Pengguna';

            $add = \DB::table('komunitas')
                ->insert(['nama_komunitas' => $request->community, 
                    'daerah' => $request->location, 
                    'tanggal_berdiri' => $request->date]);

            if ( $add )

                $request->session()->flash('alert-success', 'Task was successful!');

            else $request->session()->flash('alert-info', 'Task failed');

            return view('user/formcomm', compact('user', 'title', 'header'));
        }

        return back();
    }

    public function editCommunity(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 ) {

            $title = 'Komunitas';

            $header = 'Pengguna';

            $comm = \DB::table('komunitas')
                ->where('idkomunitas', '=', $id)
                ->first();

            return view('user/editcomm', compact('user', 'title', 'comm', 'header'));
        }

        return back();
    }

    public function updateCommunity(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 ) {

            $title = 'Komunitas';

            $header = 'Pengguna';

            $update = \DB::table('komunitas')
                ->where('idkomunitas', '=', $request->id)
                ->update(['nama_komunitas' => $request->community,
                 'daerah' => $request->location, 'tanggal_berdiri' => $request->date]);

            if ( $update )

                $request->session()->flash('alert-success', 'Task was successful!');

            else $request->session()->flash('alert-info', 'Task failed');

            return view('user/formcomm', compact('user', 'title', 'header'));

        }

        return back();
    }

    public function deletecomm(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 ) {

            $deleteusers = User::where('idkomunitas', '=', $id)->delete();
            $delete = \DB::table('komunitas')->where('idkomunitas', '=', $id)->delete();

            if( $delete) 
                $request->session()->flash('alert-success', 'Komunitas deleted');
            else $request->session()->flash('alert-danger', 'Task failed');

            $title = 'Komunitas';
            $header = 'Pengguna';
            $data = \DB::table('komunitas')->get();

            return view('user/community', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }
}
