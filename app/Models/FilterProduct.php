<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterProduct extends Model
{
    protected $fillable=[
        'product_id',
        'filter_group_id',
        'filter_group_items',
    ];

    public function filter_groups()
    {
        return $this->belongsTo(FilterGroup::class,'filter_group_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function filtergroupitem()
    {
        return FilterGroupItem::whereIn('id', $this->filter_group_items);
    }

    /**
     * Accessor for room_type property.
     *
     * @return array
     */
    public function getFilterGroupItemsAttribute($commaSeparatedIds)
    {
        if (isset($commaSeparatedIds)) {
            return explode(',', $commaSeparatedIds);
        } else {
            return [];
        }
    }


}
