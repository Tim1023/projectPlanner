<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('semesters');
        Schema::create('semesters', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->integer('max_credits')->unsigned()->default(75);
        });

        /** Seed the semesters table with static data */
        DB::table('semesters')->insert([
            'name' => 'Standard Semester',
            'type' => 'fullTime',
            'max_credits' => 75
        ]);
        DB::table('semesters')->insert([
            'name' => 'Summer Semester',
            'type' => 'partTime',
            'max_credits' => 30
        ]);

        Schema::dropIfExists('program_semester');
        Schema::create('program_semester', function(Blueprint $table){
            $table->increments('id');
            $table->integer('program_id')->unsigned();
            $table->integer('semester_id')->unsigned();
            $table->string('name');
            $table->integer('order_number')->unsigned();

            $table->foreign('program_id')
                ->references('id')
                ->on('programs')
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
        Schema::dropIfExists('program_semester');
        Schema::dropIfExists('semester');
    }
}
