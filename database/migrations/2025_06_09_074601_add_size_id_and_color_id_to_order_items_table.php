<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('order_items', function (Blueprint $table) {
        $table->unsignedBigInteger('size_id')->nullable()->after('price');
        $table->unsignedBigInteger('color_id')->nullable()->after('size_id');

        // Nếu bạn muốn tạo foreign key constraints (tuỳ chọn)
        $table->foreign('size_id')->references('id')->on('sizes')->onDelete('set null');
        $table->foreign('color_id')->references('id')->on('colors')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('order_items', function (Blueprint $table) {
        $table->dropForeign(['size_id']);
        $table->dropForeign(['color_id']);
        $table->dropColumn(['size_id', 'color_id']);
    });
}
};