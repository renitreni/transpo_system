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
            $table->dropColumn('Hours');
            $table->date('FirstTimeMaintenance')->nullable()->after('Odometer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warranty_reports', function (Blueprint $table) {
            $table->dropColumn('FirstTimeMaintenance');
            $table->string('Hours')->nullable()->after('Odometer');
        });
    }
};

