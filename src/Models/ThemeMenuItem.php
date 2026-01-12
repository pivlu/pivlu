<?php

namespace Pivlu\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ThemeMenuItem extends Model
{
    protected $fillable = [
        'menu_id',
        'parent_id',
        'type',
        'value',
        'position',
        'new_tab',
        'btn_id',
        'icon',
        'css_classes',
    ];

    protected $table = 'pivlu_theme_menu_items';

    public function allLanguagesContents(): Attribute
    {
        $all_language_contents = [];
        $langs = Language::get_languages();
        foreach ($langs as $lang) {
            $content = ThemeMenuContent::where('lang_id', $lang->id)->where('item_id', $this->id)->first();
            $all_language_contents[] = [
                'lang_id' => $lang->id,
                'lang_name' => $lang->name,
                'lang_code' => $lang->code,
                'label' => $content->label ?? null,
                'description' => $content->description ?? null,
                'custom_url' => $content->custom_url ?? null,
                'url' => $content->url ?? null
            ];
        }

        $return_data = json_decode(json_encode($all_language_contents));

        return new Attribute(
            get: fn() =>  $return_data
        );
    }

    public function default_language_content()
    {
        return $this->hasOne(ThemeMenuContent::class, 'item_id')->where('lang_id', Language::get_default_language()->id);
    }



    public function typePageData(): Attribute
    {
        if (!($this->value ?? null)) {
            return new Attribute(
                get: fn() =>  null
            );
        }
        $page_content = PostContent::where(['lang_id' => Language::get_default_language()->id, 'post_id' => (int)$this->value])->first();

        return new Attribute(
            get: fn() =>  $page_content
        );
    }
}
