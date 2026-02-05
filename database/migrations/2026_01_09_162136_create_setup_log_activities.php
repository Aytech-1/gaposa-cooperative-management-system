<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('setup_log_activities', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->text('description')->nullable();
            $table->string('performed_by')->index();
            $table->string('user_type')->index();
            $table->string('ip_address', 45)->nullable();
            $table->string('device_model')->nullable();
            $table->string('browser_name')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('setup_log_activities');
    }
};
