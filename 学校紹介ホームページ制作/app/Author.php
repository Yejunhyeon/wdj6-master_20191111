<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public $timestamps = false; //updated_at와 created_at컬럼 사용 취소
    protected $fillable = ['email', 'password'];    //화이트 리스튼
}