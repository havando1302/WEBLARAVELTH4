<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderDetailsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'name')) {
                $table->string('name')->after('user_id');
            }

            if (!Schema::hasColumn('orders', 'phone')) {
                $table->string('phone')->after('name');
            }

            if (!Schema::hasColumn('orders', 'address')) {
                $table->text('address')->after('phone');
            }

            if (!Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method')->after('address');
            }

            if (!Schema::hasColumn('orders', 'note')) {
                $table->text('note')->nullable()->after('payment_method');
            }

            if (!Schema::hasColumn('orders', 'total')) {
                $table->decimal('total', 10, 2)->after('note');
            }

            if (!Schema::hasColumn('orders', 'status')) {
                $table->string('status')->default('pending')->after('total');
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'name')) {
                $table->dropColumn('name');
            }

            if (Schema::hasColumn('orders', 'phone')) {
                $table->dropColumn('phone');
            }

            if (Schema::hasColumn('orders', 'address')) {
                $table->dropColumn('address');
            }

            if (Schema::hasColumn('orders', 'payment_method')) {
                $table->dropColumn('payment_method');
            }

            if (Schema::hasColumn('orders', 'note')) {
                $table->dropColumn('note');
            }

            if (Schema::hasColumn('orders', 'total')) {
                $table->dropColumn('total');
            }

            if (Schema::hasColumn('orders', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
}
