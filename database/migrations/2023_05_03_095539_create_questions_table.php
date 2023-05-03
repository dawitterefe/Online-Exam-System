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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade')->onUpdate('cascade');
            $table->string('question',500);
            $table->text('option_1');
            $table->text('option_2');
            $table->text('option_3')->nullable();
            $table->text('option_4')->nullable();
            $table->integer('answer');
            $table->integer('points')->default(1);
            $table->timestamps();

            $table->unique(['question', 'exam_id'], 'question_exam_unique');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
