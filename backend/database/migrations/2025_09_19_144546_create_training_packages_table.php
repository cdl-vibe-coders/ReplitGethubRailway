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
        Schema::create('training_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('duration_days')->nullable(); // Training duration in days
            $table->integer('max_participants')->nullable();
            $table->json('requirements')->nullable(); // Custom registration fields
            $table->json('file_requirements')->nullable(); // File upload requirements
            $table->text('terms_conditions')->nullable();
            $table->string('enrollment_url_token')->unique()->nullable(); // Unique enrollment token
            $table->boolean('is_active')->default(true);
            $table->boolean('allow_self_enrollment')->default(false);
            $table->json('email_templates')->nullable(); // Email templates for enrollment
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_packages');
    }
};
