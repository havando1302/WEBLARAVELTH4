<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Thêm use các model liên quan
use App\Models\Order;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductVariant;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_variant_id', // bạn cần đảm bảo cột này có trong migration
        'quantity',
        'price',
        'size_id',
        'color_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    
    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
