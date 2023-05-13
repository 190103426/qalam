<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLessonTestAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_lesson_test_answers', function (Blueprint $table) {
            $table->id();
            $table->string('test_uuid');
            $table->foreignId('question_id')->constrained('lesson_questions')->cascadeOnDelete();
            $table->integer('answer_number')->nullable();
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
        Schema::dropIfExists('user_lesson_test_answers');
    }
}
