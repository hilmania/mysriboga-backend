<?php

namespace App\Http\Controllers;

use Auth;
use App\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

        	$title = "Training";

            $header = 'Daftar Pelatihan';

        	$data = (new Training())->getTrainings();

            // dd($data);
        	return view('training/index', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function form(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {
        
        	$title = "Training";

            $header = 'Pelatihan';

            $kota = \DB::table('training_location')->get();

        	return view('training/form', compact('user', 'title', 'kota', 'header'));
        }

        return back();
    }

    public function add(Request $request)
    {
        $user = Auth::user();

        $header = 'Pelatihan';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $add = (new Training())->addTraining($user->id, $request->trainingname, $request->trainingdesc, $request->trainingdate, $request->quota, $request->trainingtype, $request->trainee, $request->location, $request->venue);

            // $topic, $description, $date, $quota, $type, $trainee, $location, $venue
            $title = "Training";

            $request->session()->flash('alert-success', 'Task was successful!');

            return back();
        }

        return back();
    }

    public function edit(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = "Training";

            $header = 'Pelatihan';

            $data = Training::find($id);

            $kota = \DB::table('training_location')->get();

            return view('training/edit', compact('user', 'title', 'data', 'header', 'kota'));
        }

        return back();
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $update = Training::find($request->id);

            $update->nama_pelatihan = $request->trainingname;
            $update->jenis_pelatihan = $request->trainingtype;
            $update->tanggal_pelatihan = $request->trainingdate;
            $update->jenis_peserta = $request->trainee;
            $update->kuota_peserta = $request->quota;
            $update->lokasi = $request->location;
            $update->alamat = $request->venue;
            $update->deskripsi = $request->trainingdesc;

            $update->save();

            $request->session()->flash('alert-success', 'Task was successful!');
        }
        else $request->session()->flash('alert-danger', 'Task failed!');
        
        $title = "Training";

        $header = 'Pelatihan';

        return back();
    }

    public function delete(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delregistran = \DB::table('training_regist')->where('id_training', '=', $id)->delete();

            $delete = Training::where('id', '=', $id)->delete();

            if ( $delete )
                $request->session()->flash('alert-success', 'Pelatihan deleted');
            else $request->session()->flash('alert-danger', 'Task failed');

            $title = "Training";

            $header = 'Pelatihan';

            $data = (new Training())->getTrainings();

            return back();
        }

        return back();
    }

    // cRUD kota pelatihan
    public function lokasitraining(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = "General";

            $header = 'Pelatihan';

            $data = \DB::table('training_location')->get();

            return view('general/trainingloc', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function deletelokasi(Request $request, $id)
    {
        $user = Auth::user();

        $header = 'Pelatihan';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delete = \DB::table('training_location')->where('idloc', $id)->delete();
            $request->session()->flash('alert-success', 'Berhasil dihapus');

            return back();
        }

        return back();
    }

    public function formlokasi(Request $request)
    {
        $user = Auth::user();

        $title = 'General';

        $header = 'Pelatihan';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            return view('general/formloc', compact('user', 'title', 'header'));
        }

        return back();
    }

    public function addlokasi(Request $request)
    {
        $user = Auth::user();

        $header = 'Pelatihan';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $add = \DB::table('training_location')->insert(['kota' => $request->kota]);

            $request->session()->flash('alert-success', 'Berhasil ditambahkan');

            return back();
        }

        return back();
    }

    public function editlokasi(Request $request, $id)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = 'General';

            $header = 'Pelatihan';
            
            $data = \DB::table('training_location')->where('idloc', $id)->first();

            return view('general/editloc', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function updatelokasi(Request $request)
    {
        $user = Auth::user();

        $header = 'Pelatihan';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            // dd($request);

            $update = \DB::table('training_location')->where('idloc', $request->id)->update(['kota' => $request->kota]);

            $request->session()->flash('alert-success', 'Berhasil diubah');

            return back();
        }

        return back();
    }

    public function registrant(Request $request, $id)
    {
    	$user = Auth::user();

    	$title = 'Training';

        $header = 'Pelatihan';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

        	$data = \DB::table('training_regist')
        		->leftJoin('training_list', 'training_list.id', '=', 'training_regist.id_training')
        		->leftJoin('users', 'users.id', '=', 'training_regist.id_user')
        		->where('id_training', $id)
        		->get();

        // dd($data);

        return view('training/registran', compact('data', 'title', 'user', 'header'));

        }

        return back();
    }
}
