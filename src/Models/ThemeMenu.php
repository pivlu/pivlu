<?php

namespace Pivlu\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeMenu extends Model
{
    protected $fillable = [
        'label',
        'is_default',
    ];

    protected $table = 'pivlu_theme_menus';

    //Get default menu
    public static function get_default_menu()
    {
        $menu = ThemeMenu::where('is_default', 1)->first();

        return $menu;
    }
}
