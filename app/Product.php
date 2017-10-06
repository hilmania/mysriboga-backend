<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'info_produk';

    public function getProducts()
    {
        $result = \DB::table('info_produk')
            ->leftJoin('info_produk_grup', 'info_produk_grup.idgroup', '=', 'info_produk.grup_produk')
            ->get();

        return $result;
    }

    public function addProduct($submitter, $product, $group, $description, $thumbnail, $slider)
    {
    	$add = \DB::table('info_produk')
    		->insert(['submitter' => $submitter,'nama_produk' => $product, 'grup_produk' => $group, 'deskripsi_produk' => $description, 'url_thumbnail' => $thumbnail, 'url_gambar' => $slider]);

    	if( $add )
    		$result = \DB::table('info_produk')
    			->where('nama_produk', '=', $product)
    			->where('grup_produk', '=', $group)
    			->where('deskripsi_produk', '=', $description)
    			->first();

    	return $result;
    }

    public function addContent($id_product, $content)
    {
    	foreach ( $content as $ct )
    		$add = \DB::table('spec_produk')
    			->insert(['id_produk' => $id_product, 'parameter' => $ct['parameter'], 'value' => $ct['value']]);

    	return 1;
    }

    public function addUseOf($id_product, $usage, $url)
    {
    	foreach ( $usage as $use ) {
            if ( empty($use['photo']) ){

                $url = '';

            } else $url = 'public/assets/images/product/useof/'.$use['photo']->getClientOriginalName();

            $add = \DB::table('useof_produk')
                ->insert(['id_produk' => $id_product, 'use_of' => $use['useof'], 'url_gambar' => $url ]);
        }
            
    	return 1;
    }
}
