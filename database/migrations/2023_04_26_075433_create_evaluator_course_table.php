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
        Schema::create('evaluator_course', function (Blueprint $table) {
            $table->id();
            $table->string('evaluator_id');
            $table->foreign('evaluator_id')->references('id')->on('evaluators')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();

            // Adding unique index on evaluator_id and course_id columns
            $table->unique(['evaluator_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluator_course');
    }
};
