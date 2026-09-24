<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('api_keys', function (Blueprint $table) {
            $table->id();
            $table->string('name');                       // who / what uses it, e.g. "Client Portal"
            $table->string('key_hash', 64)->unique();     // sha256 of the key — the plain key is never stored
            $table->string('key_prefix', 16);             // first characters, only to recognise the key in the list
            $table->timestamp('last_used_at')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('api_keys');
    }
};
