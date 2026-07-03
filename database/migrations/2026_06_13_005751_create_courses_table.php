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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_category_id')->constrained()->cascadeOnDelete();

            $table->string('title');
            $table->string('slug')->unique();
            $table->string('short_description')->nullable();

            $table->string('badge')->nullable();
            $table->string('quote')->nullable();

            $table->string('duration_title_one')->nullable();
            $table->string('duration_one')->nullable();

            $table->string('duration_title_two')->nullable();
            $table->string('duration_two')->nullable();

            $table->string('duration_title_three')->nullable();
            $table->string('duration_three')->nullable();
            $table->string('eligibility')->nullable();
            $table->string('recognition')->nullable();
            $table->string('placement_rate')->nullable();

            $table->longText('program_overview')->nullable();
            $table->longText('about_course')->nullable();

            $table->json('employment_opportunities')->nullable();
            $table->json('career_roles')->nullable();
            $table->json('graduates_work')->nullable();
            $table->json('faqs')->nullable();

            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
