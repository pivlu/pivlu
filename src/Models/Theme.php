<?php

namespace Pivlu\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'label',
        'code',
        'vendor_name',
        'theme_name',
        'style_id',
        'menu_id',
        'footer_id',
        'is_active',
        'is_builder',
    ];

    protected $table = 'pivlu_themes';

    //Get active theme
    public static function get_active_theme()
    {
        $theme = Theme::where('is_active', 1)->first();
        return $theme;
    }
}
