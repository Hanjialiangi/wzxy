<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    public $table = "auth"; 

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $fillable =['username','token'];
}