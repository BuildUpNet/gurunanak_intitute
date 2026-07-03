<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->unsignedBigInteger('course_category_id')->nullable()->after('email');
            $table->unsignedBigInteger('course_id')->nullable()->after('course_category_id');

            $table->foreign('course_category_id')
                ->references('id')->on('course_categories')
                ->nullOnDelete();

            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->nullOnDelete();
        });

        Schema::table('contact_enquiries', function (Blueprint $table) {
            $table->string('branch', 100)->nullable()->after('subject');
            $table->unsignedBigInteger('course_category_id')->nullable()->after('branch');
            $table->unsignedBigInteger('course_id')->nullable()->after('course_category_id');

            $table->foreign('course_category_id')
                ->references('id')->on('course_categories')
                ->nullOnDelete();

            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropForeign(['course_category_id']);
            $table->dropForeign(['course_id']);
            $table->dropColumn(['course_category_id', 'course_id']);
        });

        Schema::table('contact_enquiries', function (Blueprint $table) {
            $table->dropForeign(['course_category_id']);
            $table->dropForeign(['course_id']);
            $table->dropColumn(['branch', 'course_category_id', 'course_id']);
        });
    }
};
