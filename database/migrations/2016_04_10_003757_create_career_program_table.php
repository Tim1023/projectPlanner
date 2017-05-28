<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareerProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('career_program');
        Schema::create('career_program', function(Blueprint $table){
            $table->integer('career_id')->unsigned()->index();
            $table->integer('program_id')->unsigned()->index();

            $table->foreign('career_id')
                ->references('id')
                ->on('careers')
                ->onDelete('cascade');

            $table->foreign('program_id')
                ->references('id')
                ->on('programs')
                ->onDelete('cascade');

            $table->primary(['career_id', 'program_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('career_program');
    }}
