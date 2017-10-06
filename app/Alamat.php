<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $table = 'alamat';

    protected $fillable = [
    	'nama_kantor', 'alamat_kantor', 'no_telp', 'fax', 'kota', 'tipe_alamat','longitude', 'latitude'
    ];

    public $timestamps = false;

    public function getAlamat()
    {
      $result = new Alamat;

      $result->kantor = \DB::table('alamat_tipe')
      ->get();

      $result->alamat = \DB::table('alamat')
      ->leftJoin('alamat_tipe', 'alamat.tipe', '=', 'alamat_tipe.id_tipe')
      // ->groupBy('alamat.id')
      ->orderBy('alamat.tipe','asc')
      ->get();

      return $result;
    }

    public function addAlamat($nama_kantor, $alamat_kantor, $no_telp, $fax, $kota, $tipe_alamat, $longitude, $latitude)
    {
        $add = \DB::table('alamat')
            ->insert(['nama_kantor' => $nama_kantor, 'alamat_kantor' => $alamat_kantor, 'no_telp' => $no_telp, 'fax' => $fax, 
              'kota' => $kota, 'tipe' => $tipe_alamat, 'longitude' => $longitude, 'latitude' => $latitude]);

       return $add;
    }

    public function getTipeAlamat(){
      $result  = \DB::table('alamat_tipe')
      ->get();

      return $result;
    }
}
