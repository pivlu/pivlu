<?php

namespace Pivlu\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeNavItemContent extends Model
{
    protected $fillable = [
        'nav_id',
        'row_id',
        'nav_item_id',
        'lang_id',        
        'data',        
    ];

    protected $table = 'pivlu_theme_nav_item_content';

    public function nav()
    {
        return $this->belongsTo(ThemeNav::class, 'nav_id');
    }

    public function row()
    {
        return $this->belongsTo(ThemeNavRow::class, 'row_id');
    }

    public function nav_item()
    {
        return $this->belongsTo(ThemeNavItem::class, 'nav_item_id');
    }
}
