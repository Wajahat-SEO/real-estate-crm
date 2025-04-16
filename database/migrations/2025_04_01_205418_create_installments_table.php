<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // Link to customer
            $table->foreignId('plot_id')->constrained()->onDelete('cascade'); // Link to plot
            $table->foreignId('block_id')->constrained()->onDelete('cascade'); // Link to block
            $table->decimal('amount_paid', 10, 2); // Amount paid in the installment
            $table->date('installment_date'); // Date when the installment was paid
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('installments');
    }
};
