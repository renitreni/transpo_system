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
        Schema::table('customers', function (Blueprint $table) {
            $table->date('date_of_entry_iqama_number')->nullable()->after('resident_iqama_number');
            $table->date('validity_of_iqama')->nullable()->after('date_of_entry_iqama_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['date_of_entry_iqama_number', 'validity_of_iqama']);
        });
    }
};
