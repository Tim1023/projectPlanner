<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareerPathwayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('career_pathway');
        Schema::create('career_pathway', function(Blueprint $table){
            $table->integer('career_id')->unsigned()->index();
            $table->integer('pathway_id')->unsigned()->index();

            $table->foreign('career_id')
                ->references('id')
                ->on('careers')
                ->onDelete('cascade');

            $table->foreign('pathway_id')
                ->references('id')
                ->on('pathways')
                ->onDelete('cascade');

            $table->primary(['career_id', 'pathway_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('career_pathway');
    }
}
