<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('program_details', function (Blueprint $table) {
            $table->unsignedBigInteger('course_category_id')->nullable()->after('id');
            $table->foreign('course_category_id')
                  ->references('id')->on('course_categories')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('program_details', function (Blueprint $table) {
            $table->dropForeign(['course_category_id']);
            $table->dropColumn('course_category_id');
        });
    }
};
