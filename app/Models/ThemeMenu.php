<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeMenu extends Model
{
    protected $fillable = [
        'label',
        'is_default',    
    ];

    protected $table = 'pivlu_theme_menus';

}
