<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    // Images can now sit directly under a category without a sub category.
    public function up(): void
    {
        DB::statement('ALTER TABLE gallery_images MODIFY gallery_sub_category_id BIGINT UNSIGNED NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE gallery_images MODIFY gallery_sub_category_id BIGINT UNSIGNED NOT NULL');
    }
};
