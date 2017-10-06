<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
     protected $table = 'berita';

    protected $fillable = [
        'judul_berita', 'cover_berita', 'isi_berita', 
        'status_approval', 'id_user_create',
    ];

    public function getBeritaList()
    {
        return $result = \DB::table('berita')
            ->get();
    }

     public function getBeritaById($id)
    {
        $result = new News;

        $result->berita = \DB::table('berita')
            ->where('id', '=', $id)
            // ->where('approval', 1)
            ->first();

        return $result;
    }

    public function getRecipeId($id)
    {
        $result = new News;

        $result->berita = \DB::table('berita')
            ->where('id', '=', $id)
            ->first();

        // dd($result);

        return $result;
    }

    public function addBerita($judul_berita, $slider, $thumbnail, $isi_berita, $user_id)
    {
        $add = \DB::table('berita')
            ->insert(['judul_berita' => $judul_berita, 'url_slider' => $slider, 'cover_berita' => $thumbnail, 'isi_berita' => $isi_berita, 
            	'id_user_create' => $user_id]);

       return $add;
    }

}
