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
        Schema::create('tap_business_files', function (Blueprint $table) {
            $table->id();
            $table->string('business_logo_path');
            $table->string('business_logo_id');
            $table->string('customer_signature_path');
            $table->string('customer_signature_id');
            $table->string('dispute_evidence_path');
            $table->string('dispute_evidence_id');
            $table->string('identity_document_path');
            $table->string('identity_document_id');
            $table->string('pci_document_path');
            $table->string('pci_document_id');
            $table->string('tax_document_user_upload_path');
            $table->string('tax_document_user_upload_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tap_business_files');
    }
};
