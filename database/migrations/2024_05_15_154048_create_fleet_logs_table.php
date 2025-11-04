<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fleet_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fleet_id')->references('id')->on('fleets')->cascadeOnDelete();
            $table->string('location')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('employee_no')->nullable();
            $table->string('driver_type')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('equipment_type')->nullable();
            $table->string('equipment_status')->nullable();
            $table->string('equipment_no')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fleet_logs');
    }
};
