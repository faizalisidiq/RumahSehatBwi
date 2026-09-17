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
        Schema::create('therapy_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // ID Terapis

            $table->date('session_date');
            $table->unsignedTinyInteger('session_sequence'); // Sesi ke-1 s/d 10
            $table->unsignedTinyInteger('device_level'); // Level 1-5

            $table->string('current_complaint');
            $table->unsignedTinyInteger('pain_scale_before');
            $table->unsignedTinyInteger('pain_scale_after');

            $table->string('patient_feedback')->nullable(); // Misal: "Sedikit sakit"
            $table->text('evaluation_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('therapy_sessions');
    }
};
