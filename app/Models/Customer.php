<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $table = "user"; 
    public $timestamps = false;
    protected $fillable =['username','password','count','is_stop'];
}