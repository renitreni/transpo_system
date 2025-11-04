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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->uuid('Customer_uuid');
            $table->string('FullName')->default('N/A');
            $table->string('Email')->default('N/A');
            $table->string('PhoneNumber')->default('N/A');
            $table->string('FaxNumber')->default('N/A');
            $table->string('CompanyRegistration')->default('N/A');
            $table->string('CompanyName')->default('N/A');
            $table->string('OfficeAddress')->default('N/A');
            $table->string('OtherLocation')->default('N/A');
            $table->date('OrderDate')->nullable();
            $table->string('MethodPayment')->default('N/A');
            $table->string('OrderTrackNumber')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
