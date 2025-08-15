<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'label',
        'slug',
        'style_id',
        'menu_id',
        'footer_id',
        'is_default',
        'is_active_theme',
        'is_builder',        
    ];

    protected $table = 'pivlu_themes';
    
}
