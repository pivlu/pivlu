<?php

namespace Pivlu\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'label',
        'slug',
        'vendor_name',
        'theme_name',
        'style_id',
        'menu_id',
        'footer_id',
        'is_default',
        'is_active',
        'is_builder',
    ];

    protected $table = 'pivlu_themes';

    //Get default theme
    public static function get_default_theme()
    {
        $theme = Theme::where('is_default', 1)->first();

        return $theme;
    }

    //Get active theme
    public static function get_active_theme()
    {
        $theme = Theme::where('is_active', 1)->first();
        if (! $theme) $theme = Theme::get_default_theme();

        return $theme;
    }
}
