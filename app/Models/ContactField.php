<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactField extends Model
{
    protected $fillable = [
        'type',
        'required',
        'col_md',
        'active',
        'position',
    ];

    protected $table = 'pivlu_contact_fields';


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function default_lang_field()
    {
        return $this->hasOne(ContactFieldLang::class, 'field_id')->where('lang_id', Language::get_default_language()->id);
    }

    public function file()
    {
        return $this->hasOne(DriveFile::class, 'id');
    }


    public function langs()
    {
        return $this->hasMany(ContactFieldLang::class, 'field_id')->with('lang');
    }

    /*
    public function field_data()
    {
        return $this->hasOne(FormFieldData::class, 'field_id')->where('form_data_id', $this->default_lang_field->id);
    }
    */
}
