<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run the migrations.
    public function up(): void
    {
        Schema::create('member_contribution_types', function (Blueprint $table) {
            $table->id('member_contribution_type_id');
            $table->string('member_contribution_type_name', 100)->unique();
            $table->timestamps();
        });
    }

   // Reverse the migrations.
    public function down(): void
    {
        Schema::dropIfExists('member_contribution_types');
    }
};
