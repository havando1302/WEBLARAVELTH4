<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; 
use Illuminate\Support\Str; 
class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        
        if (!Category::where('slug', 'san-pham')->exists()) {
            Category::create([
                'name' => 'Sản phẩm',
                'slug' => 'san-pham',
                'parent_id' => null,
            ]);
        }

       
         $rootCategory = Category::where('slug', 'san-pham')->first();
         if ($rootCategory) {
             if (!Category::where('slug', 'Gau-be')->exists()) {
                Category::create([
                    'name' => 'Thời Trang Nam',
                     'slug' => 'Gau-be',
                     'parent_id' => $rootCategory->id,
                 ]);
            }
             if (!Category::where('slug', 'Gau-nam')->exists()) {
                 Category::create([
                     'name' => 'Thời Trang Nữ',
                     'slug' => 'Gau-nam',
                    'parent_id' => $rootCategory->id,
                 ]);
           }
         }
    }
}