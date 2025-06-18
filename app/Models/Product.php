<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image_url',
        'category_id',
    ];
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function variants()
{
    return $this->hasMany(ProductVariant::class);
}

}
