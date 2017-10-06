<?php

namespace App;

use Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'no_telp', 'tipe_user',
        'jenis_usaha', 'tgl_lahir', 'alamat_1', 'alamat_2', 'kota',
        'is_active', 'jenis_industri', 'kapasitas_prod',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Automatically creates hash for the user password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function add($submitter, $nama, $notelp, $password, $email, $usertype, $usaha, $tgl_lahir, $kota, $alamat1, $alamat2, $idkomunitas, $contact, $industri, $kapasitas, $url)
    {
        if ( $usertype != 3 ) {
            $insert = \DB::table('users')
            ->insert(['submitter' => $submitter,'no_telp' => $notelp, 'password' => bcrypt($password), 'name' => $nama, 'email' => $email, 'tipe_user' => $usertype, 'jenis_usaha' => $usaha, 'tgl_lahir' => $tgl_lahir, 'kota' => $kota, 'alamat_1' => $alamat1, 'alamat_2' => $alamat2, 'idkomunitas' => $idkomunitas, 'ukm_contact_person' => $contact, 'jenis_industri' => $industri, 'kapasitas_prod' => $kapasitas, 'is_active' => 1, 'url_profilepic' => $url ]);
            
            return 1;

        } elseif ( $usertype == 3 ) {
            $insert = \DB::table('users')
            ->insert(['submitter' => $submitter,'no_telp' => $notelp, 'password' => bcrypt($password), 'name' => $nama, 'email' => $email, 'tipe_user' => $usertype, 'jenis_usaha' => $usaha, 'tgl_lahir' => $tgl_lahir, 'kota' => $kota, 'alamat_1' => $alamat1, 'alamat_2' => $alamat2, 'idkomunitas' => $idkomunitas, 'ukm_contact_person' => $contact, 'jenis_industri' => $industri, 'kapasitas_prod' => $kapasitas, 'is_active' => 0, 'url_profilepic' => $url ]);
            
            return 1;
        }         

        return 0;
    }

    public function getAllUsersList()
    {
        $result = \DB::table('users')
            ->select(array('id', 'name', 'no_telp',
                'email', 'tipe_user', 'jenis_usaha', 'tgl_lahir',
                'alamat_1', 'alamat_2', 'kota', 'jenis_industri',
                'kapasitas_prod', 'is_active'))
            ->where('is_active', 1)
            ->get();

        return $result;
    }

    public function getListUkm($tipe_user, $is_active)
    {
        $result = \DB::table('users')
            ->select('*')
            ->where('tipe_user', '=', $tipe_user)
            ->where('is_active', '=', 1)
            ->get();

        return $result;
    }

    public function getListKomunitas()
    {
        return $result = \DB::table('komunitas')
            ->get();
    }
}
