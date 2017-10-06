<?php

namespace App\Http\Controllers;

use Auth;
use App\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function form(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = "Info";

            $list = (new Info())->getAbout();

            $header = 'About';
            // dd($list);

            return view('about/form', compact('user', 'title', 'list', 'header'));
        }

        return back();
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $title = "Info";

            $header = 'About';

        	$update = (new Info())->updateAbout($request->id, $request->about, $request->point);

        	return back();
        }

        return back();
    }

    public function faq(Request $request)
    {
        $user = Auth::user();

        $title = 'Info';

        $header = 'Frequently Asked Questions';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $data = \DB::table('faq_pertanyaan')
            ->leftJoin('faq_kategori', 'faq_kategori.idfaq_kategori', '=', 'faq_pertanyaan.idfaq_kategori')
            ->get();

            return view('faq/index', compact('user', 'title', 'data', 'header'));
        }

        return back();
    }

    public function formpertanyaan(Request $request)
    {
        $user = Auth::user();

        $title = 'Info';

        $header = 'FAQ';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $group = \DB::table('faq_kategori')
                ->get();

            return view('faq/formpertanyaan', compact('user', 'title', 'group', 'header'));

        } 

        return back();
    }

    public function addfaq(Request $request)
    {
        $user = Auth::user();

        $title = 'Info';

        $header = 'FAQ';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $add = (new Info())->addFAQ($request->cat, $request->question);

            if ( $add ) {

                $add2 = (new Info())->addAns($request->cat, $add->idfaq_pertanyaan, $request->answer);

                $request->session()->flash('alert-success', 'Berhasil ditambahkan');

            } else {
                
                $request->session()->flash('alert-danger', 'Gagal ditambahkan');

            }

            return back();

        }

        return back();
    }

    public function editfaq(Request $request, $id)
    {
        $user = Auth::user();

        $title = 'Info';

        $header = 'FAQ';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $edit = \DB::table('faq_pertanyaan')->where('idfaq_pertanyaan', $id)->first();

            $group = \DB::table('faq_kategori')
                ->get();

            return view('faq/editpertanyaan', compact('user', 'title', 'edit', 'group', 'header'));

        }

        return back();
    }

    public function updatefaq(Request $request)
    {
        $user = Auth::user();

        $title = 'Info';

        $header = 'FAQ';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $add = (new Info())->addFAQ($request->cat, $request->question);

            $update = \DB::table('faq_pertanyaan')->where('idfaq_pertanyaan', $request->id)->update(['idfaq_kategori' => $request->cat, 'pertanyaan' => $request->question]);

            if( $update ) {

                $request->session()->flash('alert-success', 'Berhasil diubah');

            } else $request->session()->flash('alert-danger', 'Gagal diubah');

            return back();

        }

        return back();
    }

    public function deletefaq(Request $request, $id)
    {
        $user = Auth::user();

        $title = 'Info';

        $header = 'FAQ';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delete = \DB::table('faq_pertanyaan')->where('idfaq_pertanyaan', $id)->delete();

            if ( $delete ) {

                $request->session()->flash('alert-success', 'Berhasil dihapus');

            } else {

                $request->session()->flash('alert-danger', 'Gagal dihapus');

            }

            return back();

        }

        return back();
    }

    public function pertanyaan(Request $request, $id)
    {
        $user = Auth::user();

        $title = 'Info';

        $header = 'Jawaban FAQ';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $data = \DB::table('faq_jawaban')
                ->where('idfaq_pertanyaan', $id)
                ->get();

            $pertanyaan = \DB::table('faq_pertanyaan')
                ->where('idfaq_pertanyaan', $id)
                ->first();

            // dd($pertanyaan);

            return view('faq/pertanyaan', compact('user', 'title', 'data', 'pertanyaan', 'header'));

        }

        return back();
    }

    public function formjawaban(Request $request, $id)
    {
        $user = Auth::user();

        $title = 'Info';

        $header = 'FAQ';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $data = \DB::table('faq_pertanyaan')
                ->where('idfaq_pertanyaan', $id)
                ->first();

            // dd($data);

            $group = \DB::table('faq_kategori')
                ->get();

            return view('faq/formjawaban', compact('user', 'title', 'data', 'group', 'header'));

        }

        return back();
    }

    public function addjawaban(Request $request)
    {
        $user = Auth::user();

        $title = 'Info';

        $header = 'FAQ';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            // $add2 = (new Info())->addAns($request->cat, $add->idfaq_pertanyaan, $request->answer);
            foreach ( $request->answer as $answer )
                $add = \DB::table('faq_jawaban')->insert(['idfaq_kategori' => $request->cat, 'idfaq_pertanyaan' => $request->id, 'jawaban' => $answer['ans']]);

            if ($add) {
                
                $request->session()->flash('alert-success', 'Berhasil ditambahkan');

            } else $request->session()->flash('alert-danger', 'Gagal ditambahkan');

            return back();

        }

        return back();
    }

    public function deletejwb(Request $request, $id)
    {
        $user = Auth::user();

        $title = 'Info';

        $header = 'FAQ';

        if ( $user->tipe_user == 0 || $user->tipe_user == 1 ) {

            $delete = \DB::table('faq_jawaban')->where('idfaq_jawaban', $id)->delete();

            if ( $delete ) {
                
                $request->session()->flash('alert-success', 'Berhasil dihapus');

            } else $request->session()->flash('alert-danger', 'Gagal dihapus');

            return back();

        }

        return back();
    }
}
