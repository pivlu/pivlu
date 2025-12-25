<?php

namespace Pivlu\Cms\Models;

use Illuminate\Database\Eloquent\Model;

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
        'icon'
    ];

    protected $table = 'pivlu_theme_menu_items';

    protected $appends = ['all_languages_contents', 'default_language_content', 'type_page_data'];


    public function getAllLanguagesContentsAttribute()
    {
        $all_language_contents = [];
        $langs = Language::get_languages();
        foreach ($langs as $lang) {
            $content = ThemeMenuContent::where('lang_id', $lang->id)->where('item_id', $this->id)->first();
            $all_language_contents[] = ['lang_id' => $lang->id, 'lang_name' => $lang->name, 'lang_code' => $lang->code, 'label' => $content->label ?? null];
        }
        return json_decode(json_encode($all_language_contents));
    }

    public function default_language_content()
    {
        return $this->hasOne(ThemeMenuContent::class, 'item_id')->where('lang_id', Language::get_default_language()->id);
    }



    public function getTypePageDataAttribute()
    {
        $page_content = PostContent::where(['lang_id' => Language::get_default_language()->id, 'post_id' => (int)$this->value])->first();

        return $page_content;
    }
}
