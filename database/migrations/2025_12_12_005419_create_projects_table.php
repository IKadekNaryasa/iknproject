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
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('project_code')->unique();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('type')->default('WEB APP');
            $table->string('customer_name');
            $table->string('email');
            $table->enum('status', ['onProgress', 'Done']);
            $table->decimal('price', 12, 2);
            $table->foreignUuid('invoice_id')->constrained('id')->on('invoices')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('total_payment', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
