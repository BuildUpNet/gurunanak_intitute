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
        Schema::create('program_details', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('short_name', 20);
            $table->string('school_name');
            $table->string('level');
            $table->string('duration');
            $table->string('locations');
            $table->string('hero_image')->nullable();
            $table->string('cta_image')->nullable();
            $table->text('quote')->nullable();
            $table->text('overview_1')->nullable();
            $table->text('overview_2')->nullable();
            $table->text('overview_3')->nullable();
            $table->text('overview_4')->nullable();
            $table->text('eligibility')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_details');
    }
};
