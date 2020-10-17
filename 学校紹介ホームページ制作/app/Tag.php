<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    //한 태그는 많은 게시판을 가질 수 있다
    public function articles() {
        return $this->belongsToMany(Article::class);
    }
}