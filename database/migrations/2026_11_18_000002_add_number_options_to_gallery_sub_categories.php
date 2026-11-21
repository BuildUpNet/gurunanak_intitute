<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Number circle left of the event title: show / hide + optional custom text
    public function up(): void
    {
        Schema::table('gallery_sub_categories', function (Blueprint $table) {
            $table->boolean('show_number')->default(true)->after('heading');
            $table->string('number_label', 6)->nullable()->after('show_number');
        });
    }

    public function down(): void
    {
        Schema::table('gallery_sub_categories', function (Blueprint $table) {
            $table->dropColumn(['show_number', 'number_label']);
        });
    }
};
