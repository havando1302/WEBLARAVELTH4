<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Thêm cột 'quantity_in_stock' nếu chưa tồn tại
            if (!Schema::hasColumn('products', 'quantity_in_stock')) {
                $table->integer('quantity_in_stock')->default(0)->after('price');
            }
            // Thêm cột 'quantity_sold' nếu chưa tồn tại
            if (!Schema::hasColumn('products', 'quantity_sold')) {
                $table->integer('quantity_sold')->default(0)->after('quantity_in_stock');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Xóa cột 'quantity_sold' khi rollback
            if (Schema::hasColumn('products', 'quantity_sold')) {
                $table->dropColumn('quantity_sold');
            }
            // Xóa cột 'quantity_in_stock' khi rollback
            if (Schema::hasColumn('products', 'quantity_in_stock')) {
                $table->dropColumn('quantity_in_stock');
            }
        });
    }
};