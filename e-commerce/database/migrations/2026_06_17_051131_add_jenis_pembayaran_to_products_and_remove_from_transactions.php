<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add jenis_pembayaran to products
        Schema::table('products', function (Blueprint $table) {
            $table->enum('jenis_pembayaran', ['cod', 'transfer'])->nullable()->after('gambar');
        });

        // Set existing products to have a default value (e.g., 'cod')
        // We'll use a raw query to update
        DB::table('products')->whereNull('jenis_pembayaran')->update(['jenis_pembayaran' => 'cod']);

        // Now change the column to NOT NULL
        Schema::table('products', function (Blueprint $table) {
            $table->enum('jenis_pembayaran', ['cod', 'transfer'])->false()->null(false)->change();
        });

        // Remove jenis_pembayaran from transactions - already removed in create_transactions_table migration
        // So we do nothing here for transactions.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove jenis_pembayaran from products
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('jenis_pembayaran');
        });

        // Add jenis_pembayaran to transactions (if needed for rollback)
        // But note: in the fresh database, we never had it, so we can skip or add as nullable.
        // For safety, we'll add it as nullable.
        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('jenis_pembayaran', ['cod', 'transfer', 'ewallet'])->nullable()->after('status_pembayaran');
        });
    }
};
