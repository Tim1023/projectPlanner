<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanPathwayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('plan_pathway');
        Schema::create('plan_pathway', function(Blueprint $table){
            $table->integer('plan_id')->unsigned()->index();
            $table->integer('pathway_id')->unsigned()->index();

            $table->foreign('plan_id')
                ->references('id')
                ->on('plan_user')
                ->onDelete('cascade');

            $table->foreign('pathway_id')
                ->references('id')
                ->on('pathways')
                ->onDelete('cascade');

            $table->primary(['plan_id', 'pathway_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_pathway');
    }
}
