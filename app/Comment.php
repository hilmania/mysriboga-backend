<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'forum_komentar';

    protected $fillable = [
    	'id_post', 'id_user', 'isi_komentar'
    ];

    public function user()
    {
    	return $this->hasOne('users')->select(array('id', 'name'));
    }

    public function getThreadScc($idthread)
    {
        $result = new Comment;

        $result->thread = \DB::table('forum_thread')
            ->leftJoin('users', 'forum_thread.id_user', '=', 'users.id')
            ->where('forum_thread.id', '=', $idthread)
            ->select(['forum_thread.id', 'id_user', 'name', 'judul_post',
            'konten_post', 'email', 'url_profilepic','gambar','forum_thread.updated_at'])
            ->where('tipe_forum',1)
            ->first();

        $result->comments = Comment::where('id_post', $idthread)
            ->leftJoin('users', 'forum_komentar.id_user', '=', 'users.id')
            ->select(['id_komentar', 'id_post', 'id_user', 'name',
            'isi_komentar', 'email', 'url_profilepic', 'forum_komentar.updated_at'])
            ->orderBy('forum_komentar.updated_at', 'desc')
            ->get();

        return $result;
    }

    public function getThreadUkm($idthread)
    {
        $result = new Comment;

        $result->thread = \DB::table('forum_thread')
            ->leftJoin('users', 'forum_thread.id_user', '=', 'users.id')
            ->where('forum_thread.id', '=', $idthread)
            ->select(['forum_thread.id', 'id_user', 'name', 'judul_post',
            'konten_post', 'email', 'url_profilepic', 'gambar','forum_thread.updated_at'])
            ->where('tipe_forum',2)
            ->first();

        $result->comments = Comment::where('id_post', $idthread)
            ->leftJoin('users', 'forum_komentar.id_user', '=', 'users.id')
            ->select(['id_komentar', 'id_post', 'id_user', 'name',
            'isi_komentar', 'email', 'url_profilepic', 'forum_komentar.updated_at'])
            ->get();

        return $result;
    }
}
