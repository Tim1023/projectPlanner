<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanSemesterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('plan_semester');
        Schema::create('plan_semester', function(Blueprint $table){
            $table->increments('id');
            $table->integer('plan_id')->unsigned()->index();
            $table->integer('academic_semester_id')->unsigned()->nullable();

            $table->foreign('plan_id')
                ->references('id')
                ->on('plan_user')
                ->onDelete('cascade');

            $table->foreign('academic_semester_id')
                ->references('id')
                ->on('academic_semesters')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_semester');
    }
}
