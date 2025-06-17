<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    /**
     * Các cột được phép gán dữ liệu hàng loạt
     */
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'payment_method',
        'note',
        'total',
        'status',
    ];

    /**
     * Quan hệ: Đơn hàng thuộc về một người dùng
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Quan hệ: Một đơn hàng có nhiều mặt hàng (order items)
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Accessor: Trạng thái hiển thị bằng tiếng Việt
     */
    public function getStatusTextAttribute()
    {
        $map = [
            'pending' => 'Chờ xử lý',
            'processing' => 'Đang xử lý',
            'shipped' => 'Đã giao hàng',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy',
        ];

        return $map[$this->status] ?? $this->status;
    }
}
