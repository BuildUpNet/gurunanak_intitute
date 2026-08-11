<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_glance_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_detail_id')->constrained()->cascadeOnDelete();
            $table->string('degree');
            $table->string('duration');
            $table->string('eligibility')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_glance_items');
    }
};
