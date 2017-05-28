<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareerCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('career_course');
        Schema::create('career_course', function(Blueprint $table){
            $table->integer('career_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();

            $table->foreign('career_id')
                ->references('id')
                ->on('careers')
                ->onDelete('cascade');

            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');

            $table->primary(['career_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('career_course');
    }
}
