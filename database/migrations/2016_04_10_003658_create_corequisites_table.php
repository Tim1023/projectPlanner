<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorequisitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('co_requisites');
        Schema::create('co_requisites', function(Blueprint $table){
            $table->integer('co_requisite_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();

            $table->foreign('co_requisite_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');

            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');

            $table->primary(['co_requisite_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('co_requisites');
    }
}
