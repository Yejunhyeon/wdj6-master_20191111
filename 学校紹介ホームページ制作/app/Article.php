<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'content'];

    protected $with = ['user'];
    //여러게시판은 한 유저를 가질 수 있음
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //한 게시판은 여러 태그를 가질 수 있음
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
    //한 게시판은 여러 첨부파일을 가질 수 있음
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    //
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
