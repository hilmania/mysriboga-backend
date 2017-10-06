<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
	protected $table = 'forum_thread';

    protected $fillable = [
    	'id_user', 'judul_post', 'konten_post',
    	'created_at', 'updated_at'
    ];

    public function comments()
    {
    	return $this->hasMany('App\Comment', 'id_post');
    }

    public function user()
    {
    	return $this->hasOne('App\User', 'id', 'id_user');
    }

    public function getThreadsScc()
    {
        $result = \DB::table('forum_thread')
            ->leftJoin('users', 'forum_thread.id_user', '=', 'users.id')
            ->select(['forum_thread.id','forum_thread.konten_post', 'id_user', 'name',
                'judul_post', 'gambar', 'block', 'sticky', 'url_profilepic','forum_thread.updated_at'])
            ->where('tipe_forum',1)
            // ->where('approval', 1)
            ->get();

        return $result;
    }

    public function getThreadsUkm()
    {
        $result = \DB::table('forum_thread')
            ->leftJoin('users', 'forum_thread.id_user', '=', 'users.id')
            ->select(['forum_thread.id','forum_thread.konten_post', 'id_user', 'name',
                'judul_post', 'gambar', 'block', 'sticky', 'url_profilepic', 'forum_thread.updated_at'])
            ->where('tipe_forum',2)
            // ->where('approval', 1)
            ->get();

        return $result;
    }
}
