<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function(Blueprint $table) {
            $table->dropColumn('level');
        });

        Schema::table('courses', function(Blueprint $table) {
            $table->enum('level', array('4', '5', '6', '7', '8', '9', '10'));
            $table->addColumn('integer','department_id')->unsigned()->nullable();
            $table->addColumn('boolean','multiterm')->default(false);

            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
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
        Schema::table('courses', function(Blueprint $table){
            $table->dropColumn('department_id');
            $table->dropColumn('multiterm');
        });
    }
}
