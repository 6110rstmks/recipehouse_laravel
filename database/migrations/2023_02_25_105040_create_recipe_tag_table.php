<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_tag', function (Blueprint $table) {
            $table->primary(['recipe_id', 'tag_id']);
            $table->bigInteger('recipe_id')->unsigned();
            $table->bigInteger('tag_id')->unsigned();

            $table->foreign('recipe_id', 'recipe_tag_table_recipeId')->references('id')->on('recipes')->onDelete('cascade');
            $table->foreign('tag_id', 'recipe_tag_table_tagId')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_tag');
    }
};
