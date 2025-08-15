<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeStyleData extends Model
{
    protected $fillable = [
        'style_id',
        'text_color',
        'text_size',
        'text_align',
        'title_size',
        'subtitle_size',
        'title_font_weight',
        'subtitle_font_weight',
        'text_font_weight',
        'link_font_weight',
        'link_color',
        'link_hover_color',
        'link_underline_color',
        'link_underline_color_hover',
        'link_decoration',
        'link_hover_decoration',
        'link_underline_tickness',
        'link_underline_offset',
        'font_family',
        'font_family_weights',
        'bg_color',
        'caption_size',
        'caption_color',
        'caption_style'
    ];

    protected $table = 'pivlu_theme_style_data';

    public function style()
    {
        return $this->belongsTo(ThemeStyle::class, 'style_id');
    }
}
