<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Display title shown on the gallery page instead of the sub category name (e.g. "2026")
    public function up(): void
    {
        Schema::table('gallery_sub_categories', function (Blueprint $table) {
            $table->string('heading', 255)->nullable()->after('slug');
        });
    }

    public function down(): void
    {
        Schema::table('gallery_sub_categories', function (Blueprint $table) {
            $table->dropColumn('heading');
        });
    }
};
