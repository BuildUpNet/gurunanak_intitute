<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Per-category gallery design: 'events' = event blocks with mosaic (default),
    // 'group' = equal-height photo grid (used for batch group photos).
    public function up(): void
    {
        Schema::table('gallery_categories', function (Blueprint $table) {
            $table->string('display_style', 20)->default('events')->after('short_description');
        });
    }

    public function down(): void
    {
        Schema::table('gallery_categories', function (Blueprint $table) {
            $table->dropColumn('display_style');
        });
    }
};
