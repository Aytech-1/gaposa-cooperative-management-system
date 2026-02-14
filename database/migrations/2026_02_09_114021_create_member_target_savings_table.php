<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run the migrations.
    public function up(): void
    {
        Schema::create('member_target_savings', function (Blueprint $table) {
            $table->id('member_target_saving_id');
            $table->string('target_name');
            $table->string('user_id');
            $table->decimal('target_amount', 14, 2);
            $table->decimal('monthly_amount', 12, 2);
            $table->decimal('current_balance', 12, 2)->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();

            $table->unique(['user_id', 'target_name']);
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('status_id')->references('status_id')->on('setup_statuses')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    // Reverse the migrations.
    public function down(): void
    {
        Schema::dropIfExists('member_target_savings');
    }
};
