<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanSemesterCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('plan_semester_course');
        Schema::create('plan_semester_course', function(Blueprint $table){
            $table->integer('plan_semester_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();
            $table->integer('status')->unsigned()->nullable(); // complete = 1, fail =0, incomplete = null

            $table->foreign('plan_semester_id')
                ->references('id')
                ->on('plan_semester')
                ->onDelete('cascade');

            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('restrict');

            $table->primary(['plan_semester_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_semester_course');
    }
}
