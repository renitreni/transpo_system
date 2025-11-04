<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fleet_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('log_id')->references('id')->on('fleet_logs')->cascadeOnDelete();
            $table->string('filename')->nullable();
            $table->string('mime')->nullable();
            $table->string('extension')->nullable();
            $table->string('size')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fleet_files');
    }
};
