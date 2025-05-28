<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $productsDirectory = 'products'; // Thư mục con trong storage/app/public/

        // 1. Đảm bảo thư mục storage/app/public/products tồn tại
        if (!Storage::disk('public')->exists($productsDirectory)) {
            Storage::disk('public')->makeDirectory($productsDirectory);
        }

        

        $productsData = [
            [
                'name' => 'Áo Phông Cotton Cao Cấp',
                'description' => 'Chất liệu cotton thoáng mát, thiết kế trẻ trung, phù hợp cho mọi hoạt động.',
                'price' => 280000,
                'stock' => 75,
                'image_url' => $productsDirectory ,
            ],
            [
                'name' => 'Quần Tây Công Sở Lịch Lãm',
                'description' => 'Form dáng chuẩn, vải không nhăn, mang lại vẻ chuyên nghiệp và tự tin.',
                'price' => 450000,
                'stock' => 40,
                'image_url' => $productsDirectory ,
            ],
            [
                'name' => 'Giày Thể Thao NIKE Air Max',
                'description' => 'Công nghệ Air Max êm ái, thiết kế năng động, siêu nhẹ và bền bỉ.',
                'price' => 1850000,
                'stock' => 25,
                'image_url' => $productsDirectory ,
            ],
            [
                'name' => 'Kính Mát Thời Trang Chống UV',
                'description' => 'Bảo vệ mắt tối ưu khỏi tia UV, gọng kính chắc chắn, kiểu dáng hiện đại.',
                'price' => 350000,
                'stock' => 60,
                'image_url' => $productsDirectory ,
            ],
            [
                'name' => 'Đồng Hồ Thông Minh Z-Series',
                'description' => 'Theo dõi sức khỏe, thông báo tiện lợi, pin trâu, chống nước.',
                'price' => 1200000,
                'stock' => 30,
                'image_url' => null, 
            ],
        ];

        foreach ($productsData as $productDetails) {
            // Tùy chọn: Kiểm tra xem file ảnh mẫu có thực sự tồn tại không
            if ($productDetails['image_url'] && !Storage::disk('public')->exists($productDetails['image_url'])) {
                // echo "Cảnh báo: File ảnh mẫu '{$productDetails['image_url']}' không tồn tại cho sản phẩm '{$productDetails['name']}'. Đặt image_url thành null.\n";
                $productDetails['image_url'] = null;
            }

            Product::updateOrCreate(
                ['name' => $productDetails['name']], // Điều kiện để tìm (hoặc tạo mới nếu không tìm thấy)
                $productDetails // Dữ liệu để tạo hoặc cập nhật
            );
        }

      
    }
}