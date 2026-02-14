<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run the migrations.
    public function up(): void
    {
        Schema::create('member_contributions', function (Blueprint $table) {
            $table->id('member_contribution_id');
            $table->unsignedBigInteger('member_contribution_type_id');
            $table->string('user_id');
            $table->decimal('amount', 14, 2);
            $table->date('contribution_date');
            $table->tinyInteger('month');
            $table->year('year');
            $table->unsignedBigInteger('status_id')->default(5); // PENDING 
            $table->string('processed_by')->nullable();
            $table->timestamps();

            $table->unique(['user_id','member_contribution_type_id','month','year'], 'unique_contribution');
            $table->foreign('member_contribution_type_id')->references('member_contribution_type_id')->on('member_contribution_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('status_id')->references('status_id')->on('setup_statuses')->onDelete('restrict')->onUpdate('cascade'); 
        });
    }

    // Reverse the migrations.
    public function down(): void
    {
        Schema::dropIfExists('member_contributions');
    }
};
