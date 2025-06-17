<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;

class Product extends Model
{
    use HasFactory;

    /**
     * Các trường có thể gán hàng loạt (mass assignment)
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image_url',
        'category_id',
    ];

    /**
     * Mỗi sản phẩm thuộc về một danh sách con (subcategory)
     */
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function variants()
{
    return $this->hasMany(ProductVariant::class);
}

}
