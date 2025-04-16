<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('plots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('block_id'); // Must be UNSIGNED to match blocks.id
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
            $table->string('plot_number');
            $table->string('size');
            $table->enum('status', ['available', 'sold', 'reserved'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plots');
    }
};
