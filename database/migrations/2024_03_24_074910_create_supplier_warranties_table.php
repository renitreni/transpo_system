<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supplier_warranties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Report_id')->references('id')->on('warranty_reports')->cascadeOnDelete();
            $table->string('OrderNumber')->nullable();
            $table->date('DateOfPurchased')->nullable();
            $table->string('FeedbackTime')->nullable();
            $table->text('CausesAnalysis')->nullable();
            $table->boolean('LooseMaterial')->default(false);
            $table->boolean('Dust')->default(false);
            $table->boolean('CoalField')->default(false);
            $table->boolean('Stones')->default(false);
            $table->boolean('Gravel')->default(false);
            $table->boolean('MetalOre')->default(false);
            $table->boolean('Plateau')->default(false);
            $table->boolean('TGreat')->default(false);
            $table->boolean('ZeroCel')->default(false);
            $table->boolean('TLess')->default(false);
            $table->string('FailureDescription')->nullable();
            $table->string('SignatureTech')->nullable();
            $table->string('DateSignatureTech')->nullable();
            $table->string('DateSignatureCustomer')->nullable();
            $table->string('SignatureCustomer')->nullable();
            $table->string('ApprovedBy')->nullable();
            $table->string('DateApproved')->nullable();
            $table->string('SupplierWarrantyApproval')->nullable();
            $table->string('DealerRequestApproval')->nullable();
            $table->string('DateWarrantySupplierRequest')->nullable();
            $table->string('ApprovalSignature')->nullable();
            $table->string('SignatureDate')->nullable();
            $table->longText('Decision')->nullable();
            $table->string('Reason')->nullable();
            $table->string('SignedBy')->nullable();
            $table->string('SignedSignature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_warranties');
    }
};
