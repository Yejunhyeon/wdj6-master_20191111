<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'confirm_code',
        'activated',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'confirm_code',
    ];

    # 이메일 인증 확인
    protected $casts = [ 
        'activated' => 'boolean',
    ];

    /* 관계 설정 Relationships */
    // 한 유저는 여러개의 게시판을 가질 수 있음
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // 한 유저는 여러개의 댓글을 쓸 수 있음
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function programs()
    {
        return $this->hasMany(Program::class);
    }
    // 한 유저는 여러개의 좋아요
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    // 슈퍼 계정 어드민 권한(AuthServiceProvider참고)
    public function isAdmin()
    {
        return ($this->id === 1) ? true : false;
    }
}
