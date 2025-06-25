<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}

    protected $table = 'post';

    protected $fillable = [
        'type', 
        'path_url', 
        'category_id', 
        'image', 
        'logo_position', 
        'business_name_position', 
        'tagline_position', 
        'phone_position', 
        'social_media_position', 
        'website_position', 
        'text_color', 
        'bg_color', 
        'text_size',  
        'font_style',  
    ];
}
