<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramRequirementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('program_requirement');
        Schema::create('program_requirement', function(Blueprint $table){
            $table->integer('program_id')->unsigned();
            $table->enum('level', array('4', '5', '6', '7', '8', '9', '10'));
            $table->integer('minimum_credits')->unsigned()->default(0);
            $table->integer('maximum_credits')->unsigned()->default(0);

            $table->foreign('program_id')
                ->references('id')
                ->on('programs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_requirement');
    }
}
