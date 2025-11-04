<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_workshops', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('description')->nullable();
            $table->string('vin')->nullable();
            $table->date('date_services')->nullable();
            $table->float('labor_cost')->nullable();
            $table->float('total_price')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_workshops');
    }
};
