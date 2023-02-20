<?php

use Illuminate\Database\Eloquent\Relations\Pivot;
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
        Schema::create('category_recipe', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->primary(['category_id', 'recipe_id']);
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('recipe_id')->unsigned();

            // foreignの第二引数は制約名
            $table->foreign('category_id', 'category_recipeTable_categoryId')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('recipe_id', 'category_recipeTable_recipeId')->references('id')->on('recipes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_recipe');
    }
};
