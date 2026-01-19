<?php

namespace Pivlu\Models;

use Dom\Attr;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ThemeNavItem extends Model
{
    protected $fillable = [
        'nav_id',
        'row_id',
        'column',
        'type',
        'menu_links_id',
        'settings',
        'position',
        'active',
    ];

    protected $table = 'pivlu_theme_nav_items';

    public function nav()
    {
        return $this->belongsTo(ThemeNav::class, 'nav_id');
    }

    public function row()
    {
        return $this->belongsTo(ThemeNavRow::class, 'row_id');
    }

    public function menuLinks(): Attribute
    {
        return new Attribute(
            get: fn() => $this->get_menu_links(),
        );
    }

    protected function get_menu_links()
    {
        if ($this->menu_links_id) {
            $val = ConfigLang::where('lang_id', Language::get_active_language()->id)->where('name', 'menu_links_' . $this->menu_links_id)->value('value');
		    $menu_links = json_decode($val);

            return $menu_links ?? [];
        } else {
            return null;
        }
    }

    public function getTranslation($field, $lang_id)
    {
        $item_content = ThemeNavItemContent::where('nav_item_id', $this->id)
            ->where('lang_id', $lang_id)
            ->first();

        if ($item_content) {
            $data = json_decode($item_content->data, true);
            return $data[$field] ?? null;
        }

        return null;
    }


    public function activeLanguageContentData(): Attribute
    {
        $item_content = ThemeNavItemContent::where('nav_item_id', $this->id)
            ->where('lang_id', Language::get_active_language()->id)
            ->first();

        if ($item_content) {
            $data = json_decode($item_content->data, true);
        } else {
            $data = null;
        }

        return new Attribute(
            get: fn() =>  $data
        );
    }
}
