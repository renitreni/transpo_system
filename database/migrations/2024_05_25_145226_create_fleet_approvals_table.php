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
        Schema::create('fleet_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rent_id')->references('id')->on('rents')->cascadeOnDelete();
            $table->string('truck_brand')->nullable();
            $table->string('truck_model')->nullable();
            $table->integer('truck_size')->nullable();
            $table->string('truck_vin')->nullable();
            $table->string('plate_number')->nullable();
            $table->string('insurance')->nullable();
            $table->string('operator_name')->nullable();
            $table->string('current_location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fleet_approvals');
    }
};
