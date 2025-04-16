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
        Schema::table('plots', function (Blueprint $table) {
            // Changing the 'status' column to a boolean type (0 or 1)
            $table->boolean('status')->default(true)->change();  // true = Available, false = Sold
        });
    }
    
    public function down()
    {
        Schema::table('plots', function (Blueprint $table) {
            // If you need to roll back, revert the column to string or other type
            $table->string('status')->change();
        });
    }
};
