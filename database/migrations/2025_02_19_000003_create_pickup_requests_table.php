<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pickup_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('category'); // plastic, glass, cans
            $table->string('category_label');
            $table->decimal('estimated_weight_kg', 8, 2);
            $table->decimal('actual_weight_kg', 8, 2)->nullable();
            $table->decimal('estimated_price', 12, 2);
            $table->decimal('final_price', 12, 2)->nullable();
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->string('address')->nullable();
            $table->dateTime('scheduled_at');
            $table->enum('status', ['pending', 'on_progress', 'completed'])->default('pending');
            $table->timestamp('admin_verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pickup_requests');
    }
};
