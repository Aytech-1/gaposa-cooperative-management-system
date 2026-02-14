<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run the migrations.
    public function up(): void
    {
        Schema::create('contribution_policies', function (Blueprint $table) {
            $table->id();
            $table->decimal('compulsory_amount', 12, 2);
            $table->decimal('minimum_amount', 12, 2);
            $table->boolean('allow_voluntary')->default(true);
            $table->boolean('allow_increment')->default(true);
            $table->date('effective_date')->unique();
            $table->string('created_by');
            $table->timestamps();
        });
    }

    // Reverse the migrations.
    public function down(): void {}
};
