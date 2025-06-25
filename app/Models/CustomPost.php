<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPost extends Model
{
    use HasFactory;
    public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}

protected $table = 'custom_post';

    protected $fillable = [
        'type', 
        'image', 
          
    ];
}
