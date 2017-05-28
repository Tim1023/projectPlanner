<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanCareerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('plan_career');
        Schema::create('plan_career', function(Blueprint $table){
            $table->integer('plan_id')->unsigned()->index();
            $table->integer('career_id')->unsigned()->index();

            $table->foreign('plan_id')
                ->references('id')
                ->on('plan_user')
                ->onDelete('cascade');

            $table->foreign('career_id')
                ->references('id')
                ->on('careers')
                ->onDelete('cascade');

            $table->primary(['plan_id', 'career_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_career');
    }
}
