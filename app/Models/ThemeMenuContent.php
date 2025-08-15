<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeMenuContent extends Model
{
    protected $fillable = [
        'menu_id',
        'item_id',    
        'lang_id',
        'label',        
    ];

    protected $table = 'pivlu_theme_menu_content';

}
