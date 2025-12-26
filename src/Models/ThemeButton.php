<?php

namespace Pivlu\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeButton extends Model
{
    protected $fillable = [
        'label',
        'is_default',
        'data'
    ];

    protected $table = 'pivlu_theme_buttons';

    protected $appends = ['data_styles'];

    public function getDataStylesAttribute()
    {
        return json_decode($this->data);
    }

}
