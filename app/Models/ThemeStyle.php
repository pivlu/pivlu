<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeStyle extends Model
{
    protected $fillable = [
        'label',
        'is_default',    
        'is_block_style',
        'data'
    ];

    protected $table = 'pivlu_theme_styles';

}
