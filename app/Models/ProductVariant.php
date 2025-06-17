<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    // Khai báo các trường được phép gán hàng loạt
    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'color_name',
        'size_name',
        'stock',    // thêm trường này để có thể gán hàng loạt
    ];

    /**
     * Mỗi biến thể thuộc về một sản phẩm
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Mỗi biến thể có một màu sắc (color)
     */
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    /**
     * Mỗi biến thể có một kích thước (size)
     */
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    /**
     * Kiểm tra biến thể còn hàng hay không
     * 
     * @return bool
     */
    public function isInStock(): bool
    {
        return $this->stock > 0;
    }

    /**
     * Giảm số lượng tồn kho sau khi bán hàng
     * 
     * @param int $quantity Số lượng muốn giảm
     * @return bool True nếu giảm thành công, false nếu không đủ hàng
     */
    public function reduceStock(int $quantity): bool
    {
        if ($this->stock < $quantity) {
            return false; // Không đủ hàng để giảm
        }

        $this->stock -= $quantity;
        return $this->save();
    }
}
