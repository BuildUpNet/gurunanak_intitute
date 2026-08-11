<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admission_applications', function (Blueprint $table) {
            $table->dropColumn([
                'father_name', 'father_occupation', 'father_mobile',
                'mother_name', 'mother_occupation', 'mother_mobile',
                'education', 'heard_from', 'heard_from_other',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('admission_applications', function (Blueprint $table) {
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_mobile', 15)->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_mobile', 15)->nullable();
            $table->json('education')->nullable();
            $table->json('heard_from')->nullable();
            $table->string('heard_from_other')->nullable();
        });
    }
};
