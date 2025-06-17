<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Inject danh mục con của "Sản phẩm" vào layout
        View::composer(['layouts.app', 'layouts.guest', 'layouts.navigation'], function ($view) {
            $mainProductCategory = Category::where('slug', 'san-pham')
                ->with(['children' => function ($query) {
                    $query->orderBy('name');
                }])
                ->first(); // ⚠️ MUST use first() not get()

            $childrenCategories = $mainProductCategory ? $mainProductCategory->children : collect();

            $view->with('childCategories', $childrenCategories);
 // truyền danh sách con, không phải danh mục chính
        });
    }
}
