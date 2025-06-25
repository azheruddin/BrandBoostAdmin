<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'city'; 
    protected $primaryKey = 'city_id'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = ['city_name', 'state_id', 'city_id']; 

    #mapping to table 'state'.
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'state_id'); 
    }
}






// class City extends Model
// {
//     use HasFactory;
//     public $incrementing = false;
//     protected $primaryKey = ['city_id','state_id'];
//     protected $fillable = ['city_name', 'state_id', 'city_id'];

//     public function state()
//     {
//         return $this->belongsTo(State::class, 'state_id', 'state_id');
//     }

// }
