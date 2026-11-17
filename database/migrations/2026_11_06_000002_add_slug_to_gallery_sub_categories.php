<?php

use App\Models\GalleryCategory;
use App\Models\GallerySubCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // SEO friendly gallery URLs: /gallery/{category-slug}/{sub-category-slug}
    public function up(): void
    {
        Schema::table('gallery_sub_categories', function (Blueprint $table) {
            $table->string('slug', 191)->nullable()->after('title');
            $table->index(['gallery_category_id', 'slug']);
        });

        // Fill slugs for existing rows (also done automatically by the app if missing)
        GalleryCategory::fillMissingSlugs(GalleryCategory::all());
        GallerySubCategory::fillMissingSlugs(GallerySubCategory::all());
    }

    public function down(): void
    {
        Schema::table('gallery_sub_categories', function (Blueprint $table) {
            $table->dropIndex(['gallery_category_id', 'slug']);
            $table->dropColumn('slug');
        });
    }
};
