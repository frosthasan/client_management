<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('package_name');
            $table->decimal('price', 10, 2);
            $table->date('paid_date');
            $table->date('expire_date');
            $table->enum('status', ['active', 'inactive', 'pending', 'cancelled'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Optional: Add indexes for better performance
            $table->index('customer_id');
            $table->index('product_id');
            $table->index('status');
            $table->index('expire_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
