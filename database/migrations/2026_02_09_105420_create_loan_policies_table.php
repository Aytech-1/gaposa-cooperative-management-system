<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run the migrations.
    public function up(): void
    {
        Schema::create('loan_policies', function (Blueprint $table) {
            $table->id('loan_policy_id');
            $table->integer('loan_multiplier'); // e.g. 10x savings
            $table->decimal('minimum_amount', 12, 2);
            $table->decimal('maximum_amount', 12, 2);
            $table->integer('min_duration_months');
            $table->integer('max_duration_months');
            $table->decimal('interest_rate', 5, 2);
            $table->unsignedBigInteger('loan_interest_type_id');
            $table->integer('eligibility_months');
            $table->boolean('allow_multiple_loans')->default(false);
            $table->string('created_by');
            $table->timestamps();

            $table->unique(['loan_interest_type_id','loan_multiplier','min_duration_months','max_duration_months'], 'unique_loan_policy');
            $table->foreign('loan_interest_type_id')->references('loan_interest_type_id')->on('loan_interest_types')->onDelete('restrict')->onUpdate('cascade');  
        });
    }

    // Reverse the migrations.
    public function down(): void
    {
        Schema::dropIfExists('loan_policies');
    }
};
