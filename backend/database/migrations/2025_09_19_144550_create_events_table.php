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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // NEW_PROFILE, FILE_UPLOAD, TRAINING_COMPLETE, LOGIN, etc.
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Actor
            $table->string('subject_type')->nullable(); // Related entity type (User, Course, etc.)
            $table->unsignedBigInteger('subject_id')->nullable(); // Related entity ID
            $table->text('description');
            $table->json('event_data')->nullable(); // Additional event context
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
