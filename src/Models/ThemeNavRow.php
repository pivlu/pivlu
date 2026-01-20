<?php

namespace Pivlu\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ThemeNavRow extends Model
{
    protected $fillable = [
        'nav_id',
        'position',  
        'active',        
        'settings',
    ];

    protected $table = 'pivlu_theme_nav_rows';

    public function nav()
    {
        return $this->belongsTo(ThemeNav::class, 'nav_id');
    }
        
    public function active_items()
    {
        return $this->hasMany(ThemeNavItem::class, 'row_id')->where('active', 1)->orderBy('position');
    }

    public function configs(): Attribute
    {
        $configs = $this->hasMany(ThemeNavRowConfig::class, 'row_id')->pluck('value', 'name')->toArray();
               
        return Attribute::make(
            get: fn () => $configs
        );
    }     

}
