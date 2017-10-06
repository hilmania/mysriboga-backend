<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
	protected $table = 'galeri';

	protected $fillable = [];

	public function getAlbum()
	{
		return $result = \DB::table('galeri_album')
            ->where('approval', 1)
            ->orderBy('updated_at')
			->get();
	}

	public function getGallery($idalbum)
	{
		$result = new Gallery;

		$result->album = \DB::table('galeri_album')
			->where('id', '=', $idalbum)
			->first();

		$result->galeri = \DB::table('galeri')
			->where('album', '=', $idalbum)
			->get();

		return $result;
	}

	public function getPhoto($idalbum, $idfoto)
	{
		return $result = \DB::table('galeri')
			->where('album', '=', $idalbum)
			->where('id', '=', $idfoto)			
			->first();
	}

	public function addAlbum($submitter, $albumname, $date, $location, $slider, $thumbnail)
	{
		$add = \DB::table('galeri_album')
			->insert(['submitter' => $submitter, 'nama_album' => $albumname, 'tanggal' => $date, 'kota' => $location, 'url_slider' => $slider, 'url_thumbnail' => $thumbnail]);

		if( $add )
			$result = \DB::table('galeri_album')
				->where('nama_album', '=', $albumname)
				->where('kota', '=', $location)
				->first();

		return $result;
	}

	public function addPictures($title, $desc, $url_gambar, $url_thumbnail, $album, $date, $location)
	{
		$add = \DB::table('galeri')
			->insert(['judul_gambar' => $title, 'deskripsi' => $desc, 'url_gambar' => $url_gambar, 'url_thumbnail' => $url_thumbnail, 'album' => $album, 'tanggal' => $date, 'kota' => $location]);

		return 1;
	}
}