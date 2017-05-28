<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_user', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('start_semester_id')->unsigned()->nullable();
            $table->integer('program_id')->unsigned()->nullable();
            $table->string('slug', 128)->unique();
            $table->string('name');
            $table->boolean('is_public')->default(0);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('start_semester_id')
                ->references('id')
                ->on('academic_semesters')
                ->onDelete('set null');

            $table->foreign('program_id')
                ->references('id')
                ->on('programs')
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
        Schema::dropIfExists('plan_user');
    }
}
