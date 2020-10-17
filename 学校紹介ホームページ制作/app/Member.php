<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable =['name','comments','filename']; // MassAssignment 대응 
}
