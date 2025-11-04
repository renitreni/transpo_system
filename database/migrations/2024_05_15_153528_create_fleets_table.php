<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fleets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rent_id')->references('id')->on('rents')->cascadeOnDelete();
            $table->string('area')->nullable();
            $table->date('date')->nullable();
            $table->string('dayName')->nullable();
            $table->string('branch_manager')->nullable();
            $table->string('motion_official')->nullable();
            $table->string('forman')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fleets');
    }
};
