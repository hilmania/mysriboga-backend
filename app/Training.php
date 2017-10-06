<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table = 'training_list';

    public function getTrainings()
    {
        $result = \DB::table('training_list')
            ->leftJoin('user_type', 'user_type.idusertype', '=', 'training_list.jenis_peserta')
            ->leftJoin('training_type', 'training_type.idtrtype', '=', 'training_list.jenis_pelatihan')
            ->get();

        return $result;
    }

    public function listTrainingAll()
    {
    	$result = \DB::table('training_list')
    		->select('*')
        ->where('approval', '=', 1)
    		->get();

    	return $result;
    }

    public function listTraining($tipe_user)
    {
    	$result = \DB::table('training_list')
    		->select('*')
    		->where('jenis_peserta', '=', $tipe_user)
            ->where('approval', '=', 1)
    		->get();

    	return $result;
    }

    public function historyTraining($user_id){
      $result = \DB::table('training_regist')
        ->select('training_regist.idreg', 'training_list.nama_pelatihan', 'training_list.tanggal_pelatihan',
        'training_list.kuota_peserta', 'training_list.lokasi', 'training_list.deskripsi',
        'training_type.nama_jenis','training_regist.approval')
        ->leftJoin('training_list', 'training_list.id', '=', 'training_regist.id_training')
        ->leftJoin('user_type', 'user_type.idusertype', '=', 'training_list.jenis_peserta')
        ->leftJoin('training_type', 'training_type.idtrtype', '=', 'training_list.jenis_peserta')
        ->where('id_user', '=', $user_id)
    		->get();

    	return $result;
    }

    public function register($training_id, $user_id)
    {
    	$register = \DB::table('training_regist')
    		->insert(['id_training' => $training_id, 'id_user' => $user_id]);

    	return true;
    }

    public function check($training_id, $user_id)
    {
    	$result = \DB::table('training_regist')
            ->select('*')
            ->where('id_training', '=', $training_id)
            ->where('id_user', '=', $user_id)
            ->first();

        return $result;
    }

    public function addTraining($submitter, $topic, $description, $date, $quota, $type, $trainee, $location, $venue)
    {
        $add = \DB::table('training_list')
            ->insert(['submitter' => $submitter, 'nama_pelatihan' => $topic, 'jenis_pelatihan' => $type, 'tanggal_pelatihan' => $date, 'jenis_peserta' => $trainee, 'lokasi' => $location, 'alamat' => $venue, 'deskripsi' => $description, 'kuota_peserta' => $quota, 'updated_at' => date('Y-m-d H:i:s')]);

        return 1;
    }
}
