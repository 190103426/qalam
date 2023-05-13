<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_questions', function (Blueprint $table) {
            $table->id();
            $table->longText('text');
            $table->longText('answer_1');
            $table->longText('answer_2');
            $table->longText('answer_3');
            $table->longText('answer_4')->nullable();
            $table->longText('answer_5')->nullable();
            $table->integer('current_answer_number');
            $table->foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_questions');
    }
}
