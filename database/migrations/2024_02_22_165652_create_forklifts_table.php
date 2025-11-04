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
        Schema::create('forklifts', function (Blueprint $table) {
            $table->id();
            $table->string('ChassisNumber')->default('N/A');
            $table->string('Stocks')->default('N/A');
            $table->string('Size')->default('N/A');
            $table->string('Height')->default('N/A');
            $table->string('Type')->default('N/A');
            $table->string('Warehouse')->default('N/A');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forklifts');
    }
};
