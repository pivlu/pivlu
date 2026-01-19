<?php

namespace Pivlu\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeNavRowConfig extends Model
{
    protected $fillable = [
        'nav_id',
        'row_id',  
        'name',        
        'value',
    ];

    protected $table = 'pivlu_theme_nav_row_config';

    public function nav()
    {
        return $this->belongsTo(ThemeNav::class, 'nav_id');
    }
    
    public function row()
    {
        return $this->belongsTo(ThemeNavRow::class, 'row_id');
    }

}
