<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run the migrations.
    public function up(): void
    {
        Schema::create('loan_interest_types', function (Blueprint $table) {
            $table->id('loan_interest_type_id');
            $table->string('loan_interest_type_name', 100)->unique();
            $table->timestamps();
        });
    }

   // Reverse the migrations.
    public function down(): void
    {
        Schema::dropIfExists('loan_interest_types');
    }
};
