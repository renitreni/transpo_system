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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->string('track_number')->unique();
            $table->string('purchase_number')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_cr')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('national_address')->nullable();
            $table->string('note')->nullable();
            $table->date('entry_date')->nullable();
            $table->date('next_payment')->nullable();
            $table->boolean('isPaid')->default(0);
            $table->integer('paymentMethod')->nullable();
            $table->float('service_amount')->nullable();
            $table->float('total_service_amount')->nullable();
            $table->float('advance_payment')->nullable();
            $table->string('transportation_details')->nullable();
            $table->string('tuv_certificate')->nullable();
            $table->boolean('saso_certificate')->nullable();
            $table->boolean('other_certificate')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('receiver_mobile_number')->nullable();
            $table->string('receiver_national_id')->nullable();
            $table->string('receiver_location')->nullable();
            $table->boolean('driver')->nullable();
            $table->integer('number_units')->default(0);
            $table->string('emp_name')->nullable();
            $table->string('emp_number')->nullable();
            $table->string('branch')->nullable();
            $table->boolean('notification_sent')->default(0);
            $table->boolean('isWorkshopApproved')->default(0);
            $table->boolean('isSalesApproved')->default(0);
            $table->boolean('isFleetApproved')->default(0);
            $table->boolean('isAccountantApproved')->default(0);
            $table->text('workshopRemark')->nullable();
            $table->text('salesRemark')->nullable();
            $table->text('fleetRemark')->nullable();
            $table->text('accountantRemark')->nullable();
            $table->string('personWorkshop')->nullable();
            $table->string('personFleet')->nullable();
            $table->string('personSales')->nullable();
            $table->string('personAccountant')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
