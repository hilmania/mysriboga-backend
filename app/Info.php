<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $fillable = [];

    public function getAbout()
    {
    	return $result = \DB::table('about')
    		->get();
    }

    public function getFaq()
    {
    	return $result =\DB::table('faq')
    		->get();
    }

    public function getFaqCategories()
    {
        return $result = \DB::table('faq_kategori')
            ->get();
    }

    public function getFaqQuestionsByCategory($idcategory)
    {
        return $result = \DB::table('faq_pertanyaan')
            ->where('idfaq_kategori', '=', $idcategory)
            ->get();
    }

    public function getFaqAnswerByQuestion($idcategory, $idquestion)
    {
        return $result = \DB::table('faq_jawaban')
            ->where('idfaq_pertanyaan', '=', $idquestion)
            ->where('idfaq_kategori', '=', $idcategory)
            ->get();
    }

    public function getProductList()
    {
        $result = \DB::table('info_produk')
            ->where('approval', '=', 1)
            ->get();

        return $result;
    }

    public function getProductById($id_product)
    {
    	$result = new Info;

    	$result->product = \DB::table('info_produk')
			->where('id', '=', $id_product)
			->first();

    	$result->specs = \DB::table('spec_produk')
    		->where('id_produk', '=', $id_product)
    		->get();

    	// $result->useof = \DB::table('useof_produk')
    	// 	->where('id_produk', '=', $id_product)
    	// 	->get();

        $result->resep = \DB::table('resep')
            ->where('produk', $id_product)
            ->get();

    	return $result;
    }
    
    public function getLokasiList()
    {
        return $result = \DB::table('info_kota')
            ->get();
    }

    public function getLokasiByKota($idkota)
    {
        $kota = \DB::table('info_kota')
            ->where('id', '=', $idkota)
            ->pluck('kota');

        $result = \DB::table('info_lokasi')
            ->where('kota', '=', $kota)
            ->get();

        return $result;
    }

    public function getLokasiById($idkota, $idlokasi)
    {
        $kota = \DB::table('info_kota')
            ->where('id', '=', $idkota)
            ->pluck('kota');

        $result = \DB::table('info_lokasi')
            ->where('kota', '=', $kota)
            ->where('id', '=', $idlokasi)
            ->first();

        return $result;
    }

    public function getSliderContent()
    {
        $result = new Info();

        $result->recipe = \DB::table('resep')
            ->orderBy('id', 'desc')
            ->where('approval', 1)
            ->first();

        $result->gallery = \DB::table('galeri_album')
            ->orderBy('id', 'desc')
            ->where('approval', 1)
            ->first();

        $result->product = \DB::table('info_produk')
            ->orderBy('id', 'desc')
            ->where('approval', 1)
            ->first();

        $result->news = \DB::table('berita')
            ->orderBy('id', 'desc')
            ->where('status_approval', 1)
            ->first();

        return $result;
    }

    public function updateAbout($ids, $titles, $contents)
    {
        // dd($titles);

        for($i=1; $i<=sizeof($titles); $i++)
            $title = \DB::table('about')
                ->where('id', '=', $i)
                ->update(['title' => $titles[$i-1]]);

        for($i=1; $i<=sizeof($contents); $i++)
            $title = \DB::table('about')
                ->where('id', '=', $i)
                ->update(['text' => $contents[$i-1]]);

        return 1;
    }

    public function addFAQ($kategori, $pertanyaan)
    {
        $add = \DB::table('faq_pertanyaan')->insert(['idfaq_kategori' => $kategori, 'pertanyaan' => $pertanyaan]);

        if ( $add )
            $result = \DB::table('faq_pertanyaan')->where('idfaq_kategori', $kategori)->where('pertanyaan', $pertanyaan)->first();

        return $result;
    }

    public function addAns($kategori, $pertanyaan, $jawaban)
    {
        foreach( $jawaban as $answer )
            $add = \DB::table('faq_jawaban')->insert(['idfaq_kategori' => $kategori, 'idfaq_pertanyaan' => $pertanyaan, 'jawaban' => $answer['ans']]);

        return 1;
    }
}
