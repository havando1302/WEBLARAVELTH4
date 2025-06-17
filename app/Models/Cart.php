<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // Nếu bảng không phải là 'carts' theo convention thì khai báo rõ
    // protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'product_id',
        'product_variant_id',
        'quantity',
        'color_id',
        'size_id',
    ];

    // Quan hệ tới bảng products
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Quan hệ tới biến thể sản phẩm
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    // Quan hệ tới bảng colors (nếu có)
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
    
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}