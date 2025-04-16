<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            if (!Schema::hasColumn('customers', 'block_id')) {
                $table->unsignedBigInteger('block_id')->nullable()->after('id');
                $table->foreign('block_id')->references('id')->on('blocks')->onDelete('set null');
            }

            if (!Schema::hasColumn('customers', 'plot_id')) {
                $table->unsignedBigInteger('plot_id')->nullable()->after('block_id');
                $table->foreign('plot_id')->references('id')->on('plots')->onDelete('set null');
            }

            if (!Schema::hasColumn('customers', 'installments')) {
                $table->decimal('installments', 10, 2)->nullable()->after('plot_id');
            }
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            if (Schema::hasColumn('customers', 'block_id')) {
                $table->dropForeign(['block_id']);
                $table->dropColumn('block_id');
            }

            if (Schema::hasColumn('customers', 'plot_id')) {
                $table->dropForeign(['plot_id']);
                $table->dropColumn('plot_id');
            }

            if (Schema::hasColumn('customers', 'installments')) {
                $table->dropColumn('installments');
            }
        });
    }
};
