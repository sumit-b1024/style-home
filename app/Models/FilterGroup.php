<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterGroup extends Model
{
    protected $fillable=[
        'name',
    ];

    public function filter_groupitems()
    {
        return $this->hasMany(FilterGroupItem::class,'filter_group_id');
    }

    public function filter_products()
    {
        return $this->hasMany(FilterProduct::class,'filter_group_id');
    }
}
