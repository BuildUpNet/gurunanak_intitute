<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('program_details', function (Blueprint $table) {
            $table->unsignedBigInteger('program_category_id')->nullable()->after('id');
            $table->foreign('program_category_id')
                  ->references('id')->on('program_categories')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('program_details', function (Blueprint $table) {
            $table->dropForeign(['program_category_id']);
            $table->dropColumn('program_category_id');
        });
    }
};
