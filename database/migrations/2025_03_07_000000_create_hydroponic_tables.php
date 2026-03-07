<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sensor_readings', function (Blueprint $table) {
            $table->id();
            $table->decimal('ph', 4, 2);
            $table->integer('ppm');
            $table->integer('water_level');
            $table->decimal('temperature', 4, 1)->nullable();
            $table->decimal('humidity', 4, 1)->nullable();
            $table->string('pump_status')->default('off');
            $table->timestamp('last_pump_activation')->nullable();
            $table->timestamps();
            $table->index('created_at');
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('event');
            $table->decimal('ph', 4, 2)->nullable();
            $table->integer('ppm')->nullable();
            $table->integer('water_level')->nullable();
            $table->string('status')->default('normal');
            $table->text('details')->nullable();
            $table->timestamps();
            $table->index('created_at');
            $table->index('status');
        });

        Schema::create('nutrient_dosings', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->string('type')->default('AB');
            $table->decimal('ppm_before', 8, 2)->nullable();
            $table->decimal('ppm_after', 8, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
        Schema::dropIfExists('nutrient_dosings');
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('sensor_readings');
    }
};
