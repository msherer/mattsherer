<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;


class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'short_description', 'description', 'image'];

    public function getPost($query)
    {
        return $query->where('id', '=', $query->id);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addComment($body)
    {
        $user_id = $this->user_id;
        $post_id = $this->post_id;
        $name = $this->user->name;

        $this->comments()->create(compact(['user_id', 'post_id', 'name', 'body']));
    }

    public function delete()
    {
        try {
            \DB::table('posts')->where('id', '=', $this->id)->delete();
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
