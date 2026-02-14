<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run the migrations.
    public function up(): void
    {
        Schema::create('ledger_types', function (Blueprint $table) {// E.G CONTRIBUTION, LOAN_DISBURSEMENT
            $table->id('ledger_type_id');
            $table->string('ledger_type_name', 100)->unique();
            $table->timestamps();
        });
    }

    // Reverse the migrations.
    public function down(): void
    {
        Schema::dropIfExists('ledger_types');
    }
};
