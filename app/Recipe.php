<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table = 'resep';

    protected $fillable = [
        'nama_resep', 'deskripsi_resep', 'nama_bahan', 
        'kuantitas_bahan', 'nomor_langkah', 'instruksi',
    ];

    public function getRecipeList()
    {
    	return $result = \DB::table('resep_kategori')
    		->get();
    }

    public function getRecipes($id_category)
    {
        return $result = \DB::table('resep')
            ->where('kategori', '=', $id_category)
            ->where('approval', '=', 1)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getRecipeById($id_recipe)
    {
    	$result = new Recipe;

    	$result->resep = \DB::table('resep')
			->where('id', '=', $id_recipe)
			->where('approval', 1)
			->first();

        $result->bahan = \DB::table('resep_bahan')
            ->leftJoin('resep_unit', 'idunit', '=', 'kuantitas_unit')
        	->where('id_resep', $id_recipe)
        	->get();

        $result->langkah = \DB::table('resep_langkah')
        	->where('id_resep', $id_recipe)
        	->get();

        // dd($result);

    	return $result;
    }

    public function addRecipe($submitter, $nama_resep, $kategori, $produk, $deskripsi_resep, $gambar, $thumbnail)
    {
        $add = \DB::table('resep')
            ->insert(['submitter' => $submitter, 'nama_resep' => $nama_resep, 'kategori' => $kategori, 'produk' => $produk, 'deskripsi_resep' => $deskripsi_resep,
                'url_gambar' => $gambar, 'url_thumbnail' => $thumbnail]);

        if( $add )
            $result = \DB::table('resep')
                ->where('nama_resep', '=', $nama_resep)
                ->first();

       return $result;
    }

    public function addIngredient($id_resep, $ingredients)
    {
        foreach ( $ingredients as $ing )
            $add = \DB::table('resep_bahan')
                ->insert(['id_resep' => $id_resep, 'nama_bahan' => $ing['ingredientname'], 'kuantitas_bahan' => $ing['quantity'], 'kuantitas_unit' => $ing['unit']]);

        return 1;
    }

    public function addInstruction($id_resep, $instruction)
    {
        $counter = 0;
        foreach ( $instruction as $inc )
            $add = \DB::table('resep_langkah')
                ->insert(['id_resep' => $id_resep, 'nomor_langkah' => ++$counter, 'instruksi' => $inc['instructiondesc']]);

        return 1;
    }
}
