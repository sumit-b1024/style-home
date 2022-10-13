<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'image',
        'price',
        'available_qty',
        'description',
        'room_type',
        'style_type',
        'room_layout',
        'country',
        'color_scheme'
    ];

    public function product_images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function addtocarts()
    {
        return $this->hasMany(AddToCart::class, 'product_id');
    }

    public function getRoomTypesAttribute()
    {
        if (!$this->relationLoaded('roomtypes')) {
            $roomtypes = RoomType::whereIn('id', $this->room_type)->get();

            $this->setRelation('roomtypes', $roomtypes);
        }

        return $this->getRelation('roomtypes');
    }

    /**
     * Access roomtypes relation query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function roomtypes()
    {
        return RoomType::whereIn('id', $this->room_type);
    }

    /**
     * Accessor for room_type property.
     *
     * @return array
     */
    public function getRoomTypeAttribute($commaSeparatedIds)
    {
        if (isset($commaSeparatedIds)) {
            return explode(',', $commaSeparatedIds);
        } else {
            return [];
        }
    }

    public function getStyleTypesAttribute()
    {
        if (!$this->relationLoaded('styletypes')) {
            $styletypes = StyleType::whereIn('id', $this->style_type)->get();

            $this->setRelation('styletypes', $styletypes);
        }

        return $this->getRelation('styletypes');
    }

    /**
     * Access roomtypes relation query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function styletypes()
    {
        return StyleType::whereIn('id', $this->style_type);
    }

    /**
     * Accessor for room_type property.
     *
     * @return array
     */
    public function getStyleTypeAttribute($commaSeparatedIds)
    {
        if (isset($commaSeparatedIds)) {
            return explode(',', $commaSeparatedIds);
        } else {
            return [];
        }
    }

    public function getRoomLayoutsAttribute()
    {
        if (!$this->relationLoaded('roomlayouts')) {
            $roomlayouts = RoomLayout::whereIn('id', $this->room_layout)->get();

            $this->setRelation('roomlayouts', $roomlayouts);
        }

        return $this->getRelation('roomlayouts');
    }

    /**
     * Access roomtypes relation query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function roomlayouts()
    {
        return RoomLayout::whereIn('id', $this->room_layout);
    }

    /**
     * Accessor for room_type property.
     *
     * @return array
     */
    public function getRoomLayoutAttribute($commaSeparatedIds)
    {
        if (isset($commaSeparatedIds)) {
            return explode(',', $commaSeparatedIds);
        } else {
            return [];
        }
    }

    public function purchase_products()
    {
        return $this->hasMany(PurchaseProduct::class,'product_id');
    }

    public function filter_products()
    {
        return $this->hasMany(FilterProduct::class,'product_id');
    }

    public function product_documents()
    {
        return $this->hasMany(ProductDocument::class, 'product_id');
    }
}
