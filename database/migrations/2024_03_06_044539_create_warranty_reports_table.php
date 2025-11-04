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
        Schema::create('warranty_reports', function (Blueprint $table) {
            $table->id();
            $table->string('Name')->nullable();
            $table->bigInteger('PhoneNumber')->nullable();
            $table->string('Company')->nullable();
            $table->string('Location')->nullable();
            $table->string('Brand')->nullable();
            $table->string('Model')->nullable();
            $table->string('VIN_ID')->nullable();
            $table->string('Odometer')->nullable();
            $table->string('Hours')->nullable();
            $table->string('PlateNumber')->nullable();
            $table->string('Color')->nullable();
            $table->string('ApprovedBy')->nullable();
            $table->date('DateApproved')->nullable();
            $table->string('Destination')->nullable();
            $table->boolean('Status')->default(false);
            $table->text('Report')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warranty_reports');
    }
};
