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
        Schema::create('section_course', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();

            $table->unique(['section_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_course');
    }
};
