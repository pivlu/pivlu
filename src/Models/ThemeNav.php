<?php

namespace Pivlu\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeNav extends Model
{
    protected $fillable = [
        'label',
        'is_default',        
        'package_id',
    ];

    protected $table = 'pivlu_theme_navs';

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
    
}
