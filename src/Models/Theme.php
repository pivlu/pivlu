<?php

namespace Pivlu\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'name',
        'code',
        'vendor_name',
        'package_name',
        'description',
        'is_active',
        'package_id',
        'menu_id',
        'footer_id',
        'views_hint',
        'is_builder',
        'meta'
    ];

    protected $table = 'pivlu_themes';

    //Get active theme
    public static function get_active_theme()
    {
        $theme = Theme::where('is_active', 1)->first();
        return $theme;
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function menu()
    {
        return $this->belongsTo(ThemeMenu::class, 'menu_id');
    }

    public function footer()
    {
        return $this->belongsTo(ThemeFooter::class, 'footer_id');
    }


    public static function update_meta($theme)
    {
        $data = ['logo_url' => null, 'favicon_url' => null];

        // Theme logo
        $logo_media_id = ThemeConfig::get_config($theme->id, 'logo_media_id');
        if ($logo_media_id) {
            $logo_model = ThemeConfig::where(['theme_id' => $theme->id, 'name' => 'logo_media_id'])->first();
            $logo_url = $logo_model->getFirstMediaUrl('theme_config_media');
            $data['logo_url'] = $logo_url;
        }

        // Theme favicon
        $favicon_media_id = ThemeConfig::get_config($theme->id, 'favicon_media_id');
        if ($favicon_media_id) {
            $favicon_model = ThemeConfig::where(['theme_id' => $theme->id, 'name' => 'favicon_media_id'])->first();
            $favicon_url = $favicon_model->getFirstMediaUrl('theme_config_media');
            $data['favicon_url'] = $favicon_url;
        }       

        $theme->data = json_encode($data);
        $theme->save();
    }
}
