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
        Schema::create('exam_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade')->onUpdate('cascade');
            $table->string('evaluator_id');
            $table->foreign('evaluator_id')->references('id')->on('evaluators')->onDelete('cascade')->onUpdate('cascade');
            $table->text('review');
            $table->boolean('approved')->default(false);
            $table->timestamps();

            $table->unique(['evaluator_id', 'exam_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_reviews');
    }
};
