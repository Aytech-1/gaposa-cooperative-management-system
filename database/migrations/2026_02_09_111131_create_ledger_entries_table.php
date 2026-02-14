<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run the migrations.
    public function up(): void
    {
        Schema::create('ledger_entries', function (Blueprint $table) {
            $table->id('ledger_entry_id');
            $table->unsignedBigInteger('ledger_type_id');
            $table->unsignedBigInteger('wallet_id');
            $table->decimal('amount', 14, 2);
            $table->decimal('balance_before', 14, 2);
            $table->decimal('balance_after', 14, 2);
            $table->string('created_by');
            $table->timestamps();

            $table->foreign('ledger_type_id')->references('ledger_type_id')->on('ledger_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('wallet_id')->references('wallet_id')->on('wallets')->onDelete('restrict')->onUpdate('cascade');
        });

    }


    // Reverse the migrations.
    public function down(): void
    {
        Schema::dropIfExists('ledger_entries');
    }
};
