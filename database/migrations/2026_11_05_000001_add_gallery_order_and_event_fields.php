<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Gallery "event" layout: admin-set photo order + description/date per sub category (event block).
    public function up(): void
    {
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->default(0)->after('is_active');
        });

        Schema::table('gallery_sub_categories', function (Blueprint $table) {
            $table->text('description')->nullable()->after('title');
            $table->date('event_date')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });

        Schema::table('gallery_sub_categories', function (Blueprint $table) {
            $table->dropColumn(['description', 'event_date']);
        });
    }
};
