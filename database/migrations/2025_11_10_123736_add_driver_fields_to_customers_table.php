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
            // Make old fields nullable
            $table->string('Email')->nullable()->change();
            $table->string('FaxNumber')->nullable()->change();
            $table->string('CompanyRegistration')->nullable()->change();
            $table->string('MethodPayment')->nullable()->change();
            
            // Add new driver fields
            $table->string('driver_name')->nullable()->after('MethodPayment');
            $table->string('car_insurance_company')->nullable()->after('driver_name');
            $table->string('resident_iqama_number')->nullable()->after('car_insurance_company');
            $table->string('driver_license_number')->nullable()->after('resident_iqama_number');
            $table->date('driver_license_expiry_date')->nullable()->after('driver_license_number');
            $table->date('insurance_expiry_date')->nullable()->after('driver_license_expiry_date');
            $table->string('driver_status')->nullable()->after('insurance_expiry_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // Revert nullable changes (restore defaults)
            $table->string('Email')->default('N/A')->change();
            $table->string('FaxNumber')->default('N/A')->change();
            $table->string('CompanyRegistration')->default('N/A')->change();
            $table->string('MethodPayment')->default('N/A')->change();
            
            // Drop new driver fields
            $table->dropColumn([
                'driver_name',
                'car_insurance_company',
                'resident_iqama_number',
                'driver_license_number',
                'driver_license_expiry_date',
                'insurance_expiry_date',
                'driver_status'
            ]);
        });
    }
};
