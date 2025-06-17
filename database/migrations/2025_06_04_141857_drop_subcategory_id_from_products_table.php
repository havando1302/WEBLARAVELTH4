<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSubcategoryIdFromProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['subcategory_id']); // Nếu có khóa ngoại
            $table->dropColumn('subcategory_id');    // Xóa cột subcategory_id
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('subcategory_id')->nullable();

            // Nếu có foreign key, bạn có thể thêm lại như sau:
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('set null');
        });
    }
}
