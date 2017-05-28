<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('courses');

        Schema::create('courses', function(Blueprint $table){
            $table->increments('id');
            $table->string('course_number', 16)->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('level')->unsigned();
            $table->integer('credits')->unsigned();
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
        Schema::drop('courses');
    }
}
