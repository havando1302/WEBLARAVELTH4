<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Tạo thư mục lưu ảnh nếu chưa có
        $productsDirectory = 'products'; 
        if (!Storage::disk('public')->exists($productsDirectory)) {
            Storage::disk('public')->makeDirectory($productsDirectory);
        }

        // Tạo category mặc định
        $defaultCategory = Category::firstOrCreate(['name' => 'Thời Trang']);

        // Dữ liệu sản phẩm
        $productsData = [
            [
                'name' => 'Áo Len Nữ',
                'description' => 'Sản phẩm hot trend nhất năm 2025, được rất nhiều các bạn trẻ săn đón',
                'price' => 280000,
                'stock' => 75,
                'image_url' => 'assets/img/Lennu.jpg', 
            ],
            [
                'name' => 'Quần Jean Nam',
                'description' => 'Quần jean nam chất lượng cao, phù hợp với mọi dịp',
                'price' => 150000,
                'stock' => 40,
                'image_url' => 'assets/img/Nam.jpg',
            ],
            [
                'name' => 'Giày Thể Thao Nữ',
                'description' => 'Sản phẩm đáng mua nhất trên thị trường',
                'price' => 85000,
                'stock' => 25,
                'image_url' => 'assets/img/GiayNu.webp', // Ảnh tĩnh
            ],
            [
                'name' => 'Kính Mát Nam',
                'description' => 'Kính mát thời trang, bảo vệ mắt khỏi tia UV',
                'price' => 180000,
                'stock' => 30,
                'image_url' => 'assets/img/KM.webp'
            ],
        ];

        foreach ($productsData as &$productDetails) {
            $productDetails['category_id'] = $defaultCategory->id;

            // Nếu ảnh dùng assets/img (ảnh tĩnh) thì không cần kiểm tra tồn tại
            if (!str_starts_with($productDetails['image_url'], 'assets/img')) {
                // Chỉ kiểm tra tồn tại nếu là ảnh lưu trong storage
                if (!Storage::disk('public')->exists($productDetails['image_url'])) {
                    $productDetails['image_url'] = null;
                }
            }

            Product::updateOrCreate(
                ['name' => $productDetails['name']],
                $productDetails
            );
        }
    }
}
