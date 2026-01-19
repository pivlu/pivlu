<?php

namespace Pivlu\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ThemeButton extends Model
{
    protected $fillable = [
        'label',
        'is_default',
        'data'
    ];

    protected $table = 'pivlu_theme_buttons';

    public function dataStyles(): Attribute
    {
        if(!($this->data ?? null)) {
            return new Attribute(
                get: fn() => null
            );
        }

        $return_data = $this->data;

        return new Attribute(
            get: fn() =>  json_decode($return_data)
        );
    }

}
