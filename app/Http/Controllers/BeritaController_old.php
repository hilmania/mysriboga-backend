<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
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
    public function index()
    {
     //    $user = Auth::user();

    	// if ( $user ) {
    	// 	$title = 'Users';
    	// 	$data = (new User())->getAllUsersList();

    	// 	return view('user/index', compact('user', 'title', 'data'));
    	// }
    	
    	// return view('/');
        echo 'hello world';
    }

    public function form(Request $request)
    {
        $user = Auth::user();

        if ( $user ) {
            $title = 'Users';

            $usaha = \DB::table('jenis_usaha')
                ->get();

            $komunitas = \DB::table('komunitas')
                ->get();

            $industri = \DB::table('jenis_industri')
                ->get();

            $kapasitas = \DB::table('kapasitas_produksi')
                ->get();

            return view('user/form', compact('user', 'title', 'komunitas', 'industri', 'kapasitas', 'usaha'));
        }
    }

    public function add(Request $request)
    {
        $user = Auth::user();

        if ( $user ) {

            $title = 'Users';

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
    }

    public function edit($id)
    {
        $user = Auth::user();

        $title = 'Users';

        $data = User::find($id);

        $komunitas = \DB::table('komunitas')
            ->get();

        return view('user/edit', compact('user', 'title', 'data', 'komunitas'));
    }

    public function profile()
    {
        $user = Auth::user();

        if ( $user ) {

        	$title = 'Profile';

	        $data = User::find($user->id);

	        return view('user/profile', compact('user', 'title', 'data'));	
        }

    }

    public function upprofile(Request $request)
    {
         $user = Auth::user();

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
    }

    public function update(Request $request)
    {
        $user = Auth::user();

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
    }

    public function changepass($id)
    {
        $user = Auth::user();
        $title = 'Users';

        $data = User::find($id);

        return view('user/changepass', compact('user', 'title', 'data'));
    }

    public function changeuserpass()
    {
        $user = Auth::user();
        $title = 'Users';

        $data = User::find($user->id);

        return view('user/changepass', compact('user', 'title', 'data'));
    }

    public function updatepass(Request $request)
    {
        $user = Auth::user();

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
    }

    public function delete(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user ) {
            $delete = User::where('id', '=', $id)->delete();

            if ( $delete )
                $request->session()->flash('alert-success', 'User deleted');
            else $request->session()->flash('alert-danger', 'Task failed');
        } 

        $title = 'Users';
        $data = (new User())->getAllUsersList();

        return view('user/index', compact('user', 'title', 'data'));
    }

    public function community()
    {
        $user = Auth::user();

        if ( $user ) {

            $title = 'Komunitas';
            $data = \DB::table('komunitas')->get();

            return view('user/community', compact('user', 'title', 'data'));
        }
    }

    public function formCommunity()
    {
        $user = Auth::user();

        if ( $user ) {

            $title = 'Komunitas';

            return view('user/formcomm', compact('user', 'title'));
        }
    }

    public function addCommunity(Request $request)
    {
        $user = Auth::user();

        if ( $user ) {

            $title = 'Komunitas';

            $add = \DB::table('komunitas')
                ->insert(['nama_komunitas' => $request->community, 
                    'daerah' => $request->location, 
                    'tanggal_berdiri' => $request->date]);

            if ( $add )

                $request->session()->flash('alert-success', 'Task was successful!');

            else $request->session()->flash('alert-info', 'Task failed');

            return view('user/formcomm', compact('user', 'title'));   
        }
    }

    public function editCommunity($id)
    {
        $user = Auth::user();

        $title = 'Komunitas';

        $comm = \DB::table('komunitas')
            ->where('idkomunitas', '=', $id)
            ->first();

        return view('user/editcomm', compact('user', 'title', 'comm'));
    }

    public function updateCommunity(Request $request)
    {
        $user = Auth::user();

        if ( $user ) {

            $title = 'Komunitas';

            $update = \DB::table('komunitas')
                ->where('idkomunitas', '=', $request->id)
                ->update(['nama_komunitas' => $request->community,
                 'daerah' => $request->location, 'tanggal_berdiri' => $request->date]);

            if ( $update )

                $request->session()->flash('alert-success', 'Task was successful!');

            else $request->session()->flash('alert-info', 'Task failed');

            return view('user/formcomm', compact('user', 'title'));

        }
    }

    public function deletecomm(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user ) {

            $deleteusers = User::where('idkomunitas', '=', $id)->delete();
            $delete = \DB::table('komunitas')->where('idkomunitas', '=', $id)->delete();

            if( $delete) 
                $request->session()->flash('alert-success', 'Komunitas deleted');
            else $request->session()->flash('alert-danger', 'Task failed');

            $title = 'Komunitas';
            $data = \DB::table('komunitas')->get();

            return view('user/community', compact('user', 'title', 'data'));
        }
    }
}
