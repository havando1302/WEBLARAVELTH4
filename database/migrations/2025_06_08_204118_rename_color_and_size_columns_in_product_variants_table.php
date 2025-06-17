<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColorAndSizeColumnsInProductVariantsTable extends Migration
{
    public function up()
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->renameColumn('color', 'color_name');
            $table->renameColumn('size', 'size_name');
        });
    }

    public function down()
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->renameColumn('color_name', 'color');
            $table->renameColumn('size_name', 'size');
        });
    }
}
