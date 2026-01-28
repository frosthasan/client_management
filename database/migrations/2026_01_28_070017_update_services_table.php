<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Add new columns
            $table->string('domain')->nullable()->after('product_id');
            $table->enum('billing_cycle', ['one_time', 'monthly', 'quarterly', 'yearly'])
                  ->nullable()->after('domain');

            // Remove package_name column
            $table->dropColumn('package_name');

            // Update status enum if needed (optional, but recommended)
            $table->enum('status', ['active', 'inactive', 'pending', 'cancelled', 'suspended', 'expired'])
                  ->default('active')->change();
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Reverse the changes
            $table->dropColumn('domain');
            $table->dropColumn('billing_cycle');
            $table->string('package_name')->after('product_id');

            // Revert status enum
            $table->enum('status', ['active', 'inactive', 'pending', 'cancelled'])
                  ->default('active')->change();
        });
    }
};
