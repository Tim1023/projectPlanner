<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursePathwayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pathway_semester');
        Schema::create('pathway_semester', function(Blueprint $table){
            $table->increments('id');
            $table->integer('pathway_id')->unsigned();
            $table->integer('semester_id')->unsigned();
            $table->string('name');
            $table->integer('order_number')->unsigned();

            $table->foreign('pathway_id')
                ->references('id')
                ->on('pathways')
                ->onDelete('cascade');

            $table->foreign('semester_id')
                ->references('id')
                ->on('semesters')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pathway_semester');
    }
}