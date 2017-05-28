<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramSemesterCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('program_semester_course');
        Schema::create('program_semester_course', function(Blueprint $table){
            $table->integer('program_semester_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();

            $table->foreign('program_semester_id')
                ->references('id')
                ->on('program_semester')
                ->onDelete('cascade');

            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');

            $table->primary(['course_id', 'program_semester_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_semester_course');
    }
}
