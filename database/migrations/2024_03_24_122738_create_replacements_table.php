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
        Schema::create('replacements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->references('id')->on('supplier_warranties')->cascadeOnDelete();
            $table->string('FPCN')->nullable();
            $table->string('RPCN')->nullable();
            $table->string('NameModel')->nullable();
            $table->integer('Quantity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replacements');
    }
};
