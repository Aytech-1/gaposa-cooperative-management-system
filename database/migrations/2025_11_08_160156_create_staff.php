<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run the migrations.
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->string('staff_id')->primary();
            $table->unsignedBigInteger('title_id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->unsignedBigInteger('gender_id');
            $table->string('email')->unique();
            $table->string('mobile_number')->unique();
            $table->string('home_address');
            $table->string('passport')->default('default.png')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->string('password');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->dateTime('last_login_at')->nullable();
            $table->timestamps();

            $table->foreign('title_id')->references('title_id')->on('setup_titles')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('gender_id')->references('gender_id')->on('setup_genders')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('status_id')->references('status_id')->on('setup_statuses')->onDelete('restrict')->onUpdate('cascade');
        });
    }
    // Reverse the migrations.
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
