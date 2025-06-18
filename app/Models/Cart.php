<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'product_variant_id',
        'quantity',
        'color_id',
        'size_id',
    ];

    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

        public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

       public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
    
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}