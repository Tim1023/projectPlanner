<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('programs', function(Blueprint $table){
            $table->addColumn('integer', 'fulltime_terms')->unsigned();
            $table->addColumn('integer', 'parttime_terms')->unsigned();
            $table->addColumn('integer', 'department_id')->unsigned()->nullable();
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
        Schema::table('programs', function(Blueprint $table){
            $table->dropColumn('department_id');
            $table->dropColumn('parttime_terms');
            $table->dropColumn('fulltime_terms');
        });
    }
}
