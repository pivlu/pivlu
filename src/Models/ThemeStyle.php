<?php

namespace Pivlu\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeStyle extends Model
{
    protected $fillable = [
        'label',
        'style',
        'is_default',    
        'is_block_style',
        'data'
    ];

    protected $table = 'pivlu_theme_styles';

}
