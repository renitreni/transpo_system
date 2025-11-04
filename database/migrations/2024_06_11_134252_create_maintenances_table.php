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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('company_cr')->nullable(); // 'company_cr',
            $table->string('contact_person')->nullable(); // 'contact_person',
            $table->string('phone_no')->nullable(); // 'phone_no',
            $table->string('email')->nullable(); // 'email',
            $table->text('address')->nullable(); // 'address',
            $table->text('note')->nullable(); // 'note',
            $table->string('brand_name')->nullable(); // 'brand_name',
            $table->string('kilometers')->nullable(); // 'kilometers',
            $table->string('hour')->nullable(); // 'hour',
            $table->string('warranty')->nullable(); // 'warranty',
            $table->text('others')->nullable(); // 'others',
            $table->string('vin_no')->nullable(); // 'vin_no',
            $table->text('remarks')->nullable(); // 'remarks'
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
