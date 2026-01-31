<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            // Essential contact info
            $table->string('phone')->nullable()->after('user_id');

            // Personal info
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('phone');
            $table->date('date_of_birth')->nullable()->after('gender');

            // Professional registration
            $table->string('registration_number')->nullable()->after('qualification'); // BMDC number
            $table->date('registration_date')->nullable()->after('registration_number');

            // Additional info
            $table->json('languages')->nullable()->after('bio'); // ["Bengali", "English", "Hindi"]
            $table->json('education')->nullable()->after('languages'); // Detailed education history
            $table->json('services')->nullable()->after('education'); // Services offered
            $table->json('awards')->nullable()->after('services'); // Awards/Achievements

            // Service options
            $table->boolean('online_consultation')->default(false)->after('consultation_fee');
            $table->decimal('online_fee', 10, 2)->nullable()->after('online_consultation');
            $table->boolean('home_visit')->default(false)->after('online_fee');
            $table->decimal('home_visit_fee', 10, 2)->nullable()->after('home_visit');

            // Social links
            $table->string('website')->nullable()->after('clinic_address');
            $table->string('facebook')->nullable()->after('website');
            $table->string('linkedin')->nullable()->after('facebook');

            // Additional media
            $table->string('cover_image')->nullable()->after('profile_image');
            $table->json('gallery')->nullable()->after('cover_image'); // Multiple clinic photos

            // SEO & verification
            $table->string('slug')->nullable()->unique()->after('id');
            $table->boolean('is_verified')->default(false)->after('is_featured');
            $table->timestamp('verified_at')->nullable()->after('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'gender',
                'date_of_birth',
                'registration_number',
                'registration_date',
                'languages',
                'education',
                'services',
                'awards',
                'online_consultation',
                'online_fee',
                'home_visit',
                'home_visit_fee',
                'website',
                'facebook',
                'linkedin',
                'cover_image',
                'gallery',
                'slug',
                'is_verified',
                'verified_at',
            ]);
        });
    }
};
