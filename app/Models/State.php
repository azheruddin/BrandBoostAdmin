<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $table = 'state'; 
    protected $primaryKey = 'state_id'; # Primary Key
    public $incrementing = false; # Prevent auto-incrementing for custom primary keys
    protected $keyType = 'string'; # Adjust if `state_id` is not an integer

    protected $fillable = ['state_name']; 

    #mapping
    public function cities()
    {
        return $this->hasMany(City::class, 'state_id', 'state_id'); 
    }
}





// class State extends Model
// {
//     use HasFactory;

//     protected $table = 'state';

//     // Define primary key if it's not 'id'
//     protected $primaryKey = 'state_id';

//     // Allow these fields to be mass-assigned
//     protected $fillable = ['state_name'];

//     public function cities()
//     {
//         return $this->hasMany(City::class, 'state_id', 'state_id');
//     }
// }
