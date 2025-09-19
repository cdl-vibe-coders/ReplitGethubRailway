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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('training_history')->nullable(); // Detailed training history
            $table->json('attendance_records')->nullable(); // Calendar attendance data
            $table->json('file_compliance')->nullable(); // Required files tracking
            $table->json('color_tags')->nullable(); // Organization tags
            $table->json('custom_fields')->nullable(); // Admin-defined custom fields
            $table->text('notes')->nullable(); // Admin/trainer notes
            $table->json('communication_history')->nullable(); // Message history
            $table->json('transaction_history')->nullable(); // Payment history
            $table->boolean('is_archived')->default(false);
            $table->timestamp('last_activity_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
