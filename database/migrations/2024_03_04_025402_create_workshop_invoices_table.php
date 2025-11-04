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
        Schema::create('workshop_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Customer_id')->references('id')->on('workshop_customers')->cascadeOnDelete();
            $table->float('ServiceFee')->default(0);
            $table->float('WorkshopFee')->default(0);
            $table->float('UnitAmount')->default(0);
            $table->float('TotalAmount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshop_invoices');
    }
};
