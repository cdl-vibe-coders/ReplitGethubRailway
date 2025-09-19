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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('training_package_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('status', ['pending', 'enrolled', 'in_progress', 'completed', 'cancelled', 'failed'])->default('pending');
            $table->json('enrollment_data')->nullable(); // Custom registration field responses
            $table->json('uploaded_files')->nullable(); // Required file uploads
            $table->decimal('amount_paid', 10, 2)->nullable();
            $table->string('payment_status')->default('pending');
            $table->string('payment_transaction_id')->nullable();
            $table->dateTime('enrolled_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->decimal('completion_percentage', 5, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
