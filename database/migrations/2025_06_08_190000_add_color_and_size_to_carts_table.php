<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
       
        if (!Schema::hasColumn('carts', 'color_id')) {
            Schema::table('carts', function (Blueprint $table) {
                $table->unsignedBigInteger('color_id')->nullable();
            });
            Schema::table('carts', function (Blueprint $table) {
                $table->foreign('color_id')->references('id')->on('colors')->onDelete('set null');
            });
        }

      
        if (!Schema::hasColumn('carts', 'size_id')) {
            Schema::table('carts', function (Blueprint $table) {
                $table->unsignedBigInteger('size_id')->nullable();
            });
            Schema::table('carts', function (Blueprint $table) {
                $table->foreign('size_id')->references('id')->on('sizes')->onDelete('set null');
            });
        }
    }

    public function down()
    {
        // Xóa khóa ngoại trước rồi mới xóa cột
        Schema::table('carts', function (Blueprint $table) {
            if (Schema::hasColumn('carts', 'color_id')) {
                $table->dropForeign(['color_id']);
                $table->dropColumn('color_id');
            }
            if (Schema::hasColumn('carts', 'size_id')) {
                $table->dropForeign(['size_id']);
                $table->dropColumn('size_id');
            }
        });
    }
};

