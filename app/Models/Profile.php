<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
   
    

    protected $table = 'profile';

    protected $fillable = [
        
        'type', 
        'profile_logo', 
        'whatsappno', 
        'website', 
        'instagram_facebook', 
        'bussiness_name', 
        'tagline', 
        'state', 
        'city', 
        'address', 
        'user_id',
    ];
  
}
