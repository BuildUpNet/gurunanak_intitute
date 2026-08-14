<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_images', function (Blueprint $table) {
            $table->id();
            $table->string('image');           // stored file path
            $table->string('alt_text')->nullable();
            $table->enum('position', ['main', 'accent'])->default('main'); // main = large, accent = small overlay
            $table->unsignedTinyInteger('status')->default(1);             // 1 = active, 0 = inactive
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_images');
    }
};
