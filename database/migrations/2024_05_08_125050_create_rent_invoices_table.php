<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rent_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rent_id')->references('id')->on('rents')->cascadeOnDelete();
            $table->string('invoice_number');
            $table->dateTime('paid_date');
            $table->boolean('status');
            $table->float('amount_paid')->default(0)->nullable();
            $table->float('advance_payment')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_invoices');
    }
};
