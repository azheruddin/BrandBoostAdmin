<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\Users as Authenticatable;


class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name','phone', 'password', 
        'active','subscription_id', 'user_type', 
    ];

   
}
