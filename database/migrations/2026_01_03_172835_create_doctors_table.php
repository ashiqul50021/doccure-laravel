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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('speciality_id')->constrained()->onDelete('cascade');
            $table->string('qualification');
            $table->text('bio')->nullable();
            $table->string('clinic_name')->nullable();
            $table->string('clinic_address')->nullable();
            $table->decimal('consultation_fee', 10, 2)->default(0);
            $table->integer('experience_years')->default(0);
            $table->string('profile_image')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
