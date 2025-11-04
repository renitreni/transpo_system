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
        Schema::create('workshop_customers', function (Blueprint $table) {
            $table->id();
            $table->string('Customer_Name')->default('N/A');
            $table->float('Balance_Amount')->default(0);
            $table->float('SubTotal')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshop_customers');
    }
};
