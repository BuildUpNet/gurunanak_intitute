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
        Schema::table('announcements', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
            $table->string('tag')->nullable()->after('slug');
            $table->string('excerpt', 500)->nullable()->after('tag');
            $table->longText('content')->nullable()->after('excerpt');
            $table->date('date')->nullable()->after('content');
            $table->string('image')->nullable()->after('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn(['slug', 'tag', 'excerpt', 'content', 'date', 'image']);
        });
    }
};
