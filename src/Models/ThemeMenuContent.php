<?php

namespace Pivlu\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ThemeMenuContent extends Model
{
    protected $fillable = [
        'menu_id',
        'item_id',
        'lang_id',
        'label',
        'description',
        'custom_url',
    ];

    // Table name
    protected $table = 'pivlu_theme_menu_content';


    /**      
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function theme_menu_item()
    {
        return $this->belongsTo(ThemeMenuItem::class, 'item_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function url(): Attribute
    {
        $item = ThemeMenuItem::find($this->item_id);
        $language = Language::find($this->lang_id);

        if ($item->type == 'home')
            if ($this->lang_id == Language::get_default_language()->id)
                $return = route('home');
            else
                $return = route('locale.home', ['lang' => $language->code]);

        if ($item->type == 'page') {
            $page_content = PostContent::where(['lang_id' => $this->lang_id, 'post_id' => (int)$item->value])->first();
            if ($page_content) {
                $return = $page_content->url ?? null;
            } else {
                $return = null;
            }
        }

        if ($item->type == 'post_type') {
            $post_type_content = PostTypeContent::where(['lang_id' => $this->lang_id, 'post_type_id' => (int)$item->value])->first();
            if ($post_type_content) {
                $return = $post_type_content->url ?? null;
            } else {
                $return = null;
            }
        }

        if ($item->type == 'custom') {
            $return = null;
            if ($this->custom_url) {
                if (str_starts_with($this->custom_url, 'http://') || str_starts_with($this->custom_url, 'https://')) {
                    $return = $this->custom_url;
                } else {
                    $return = 'https://' . $this->custom_url;
                }
            }
        }

        return new Attribute(
            get: fn() =>  $return ?? null
        );
    }
}
