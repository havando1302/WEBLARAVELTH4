<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            if (!Schema::hasColumn('product_variants', 'color_id')) {
                $table->foreignId('color_id')->constrained('colors')->onDelete('cascade');
            }
            if (!Schema::hasColumn('product_variants', 'size_id')) {
                $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropForeign(['color_id']);
            $table->dropForeign(['size_id']);
            $table->dropColumn(['color_id', 'size_id']);
        });
    }
};