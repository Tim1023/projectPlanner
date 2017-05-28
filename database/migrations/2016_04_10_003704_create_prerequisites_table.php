<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrerequisitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pre_requisites');
        Schema::create('pre_requisites', function(Blueprint $table){
            $table->integer('pre_requisite_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();

            $table->foreign('pre_requisite_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');

            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');

            $table->primary(['pre_requisite_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pre_requisites');
    }
}
