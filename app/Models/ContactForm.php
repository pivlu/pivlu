<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactForm extends Model
{
    use SoftDeletes;
    
    protected $fillable = [        
        'name',
        'email',
        'subject',
        'message',
        'ip',
        'referer',
        'created_at',
        'read_at',
        'responded_at',
        'is_important',
        'is_spam',
        'source_lang_id',        
    ];

    protected $table = 'pivlu_contact_forms';

    public $timestamps = false;

    public function lang(): BelongsTo
    {
        return $this->BelongsTo(Language::class, 'source_lang_id');
    }
}
