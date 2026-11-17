<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Awards & Recognition moves to its own page with MANY sections.
 * award_sections = one heading + description; awards = images, each belonging to a section.
 * Existing images (old single About-page section) are moved into one default section.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('award_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::table('awards', function (Blueprint $table) {
            $table->foreignId('award_section_id')->nullable()->after('id')
                ->constrained('award_sections')->cascadeOnDelete();
        });

        if (DB::table('awards')->exists()) {
            $settings = DB::table('site_settings')->whereIn('key', ['awards_title', 'awards_description'])->pluck('value', 'key');

            $sectionId = DB::table('award_sections')->insertGetId([
                'title'       => $settings['awards_title'] ?? 'Awards & Recognitions',
                'description' => $settings['awards_description']
                    ?? "GNIMT's consistent contributions to healthcare education and skill development have been recognized through several prestigious national and international honors.",
                'sort_order'  => 1,
                'status'      => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            DB::table('awards')->update(['award_section_id' => $sectionId]);
        }
    }

    public function down(): void
    {
        Schema::table('awards', function (Blueprint $table) {
            $table->dropConstrainedForeignId('award_section_id');
        });
        Schema::dropIfExists('award_sections');
    }
};
