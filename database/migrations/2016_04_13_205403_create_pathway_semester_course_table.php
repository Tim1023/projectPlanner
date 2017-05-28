<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePathwaySemesterCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pathway_semester_course');
        Schema::create('pathway_semester_course', function(Blueprint $table){
            $table->integer('pathway_semester_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();

            $table->foreign('pathway_semester_id')
                ->references('id')
                ->on('pathway_semester')
                ->onDelete('cascade');

            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');

            $table->primary(['course_id', 'pathway_semester_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pathway_semester_course');
    }
}
