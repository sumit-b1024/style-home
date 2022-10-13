<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDocument extends Model
{
    protected $fillable=[
        'product_id',
        'document_name',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
