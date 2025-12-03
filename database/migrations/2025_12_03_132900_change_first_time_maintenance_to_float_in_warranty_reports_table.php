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
        Schema::table('warranty_reports', function (Blueprint $table) {
            // Change FirstTimeMaintenance from date to decimal to store hours as float
            $table->decimal('FirstTimeMaintenance', 10, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warranty_reports', function (Blueprint $table) {
            // Revert back to date type
            $table->date('FirstTimeMaintenance')->nullable()->change();
        });
    }
};
