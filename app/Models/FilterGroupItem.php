<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterGroupItem extends Model
{
    protected $fillable=[
        'filter_group_id',
        'item_name',
    ];

    public function filter_groups()
    {
        return $this->belongsTo(FilterGroup::class,'filter_group_id');
    }

}
