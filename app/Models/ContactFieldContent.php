<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactFieldContent extends Model
{
    protected $fillable = [
        'field_id',
        'lang_id',
        'label',
        'info',
        'dropdowns',
    ];

    protected $table = 'pivlu_contact_field_content';

    public $timestamps = false;

    public function default_lang()
    {
        return $this->belongsTo(Language::get_default_language(), 'lang_id');
    }

    public function lang()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }

    public function field()
    {
        return $this->belongsTo(ContactField::class, 'field_id');
    }

    public function data()
    {
        return $this->hasOne(ContactFieldData::class, 'field_id')->where('form_data_id', $this->form_data_id);
    }
}
