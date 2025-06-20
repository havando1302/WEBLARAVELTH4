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
    Schema::table('products', function (Blueprint $table) {
        $table->string('short_description', 500)->nullable()->after('name'); // hoặc vị trí phù hợp
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('short_description');
    });
}

};
