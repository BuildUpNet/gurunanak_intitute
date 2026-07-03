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
        Schema::create('admission_applications', function (Blueprint $table) {
            $table->id();

            $table->string('candidate_name');
            $table->string('course_name');
            $table->string('gender');
            $table->string('category');
            $table->string('category_other')->nullable();
            $table->date('dob');
            $table->string('place_of_birth');
            $table->string('aadhaar_no', 20);

            $table->string('father_name');
            $table->string('father_occupation')->nullable();
            $table->string('father_mobile', 15)->nullable();
            $table->string('mother_name');
            $table->string('mother_occupation')->nullable();
            $table->string('mother_mobile', 15)->nullable();

            $table->string('nationality')->default('Indian');
            $table->string('country_citizenship')->default('India');
            $table->text('permanent_address');
            $table->string('mobile', 15);
            $table->string('email')->nullable();

            $table->json('education');
            $table->json('heard_from')->nullable();
            $table->string('heard_from_other')->nullable();

            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_applications');
    }
};
