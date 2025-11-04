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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('Order_uuid');
            $table->foreignId('Customer_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->string('Product')->default('N/A');
            $table->string('Color')->default('N/A');
            $table->string('ChassisNumber')->default('N/A');
            $table->integer('YearModel')->default(0);
            $table->integer('WarrantyPeriod')->default(0);
            $table->string('WarrantyExpiration')->default('N/A');
            $table->date('Order_Date')->nullable();
            $table->bigInteger('Quantity')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
