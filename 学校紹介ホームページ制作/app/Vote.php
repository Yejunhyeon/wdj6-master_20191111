<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Vote extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'comment_id',
        'up',
        'down',
        'voted_at',
    ];
    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'user_id',
        'up',
        'down',
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'voted_at',
    ];
    /* Relationships */

    //하나의 댓글은 여러개의 좋아요,싫어요를 가짐
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
    //한 유저는 여러가지 글에 좋아요, 싫어요를 할 수 있음
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /* Mutators */
    //좋아요
    // public function setUpAttribute($value)
    // {
    //     $this->attributes['up'] = $value ? 1 : 0;
    // }
    // //싫어요
    // public function setDownAttribute($value)
    // {
    //     $this->attributes['down'] = $value ? 1 : 0;
    // }
}