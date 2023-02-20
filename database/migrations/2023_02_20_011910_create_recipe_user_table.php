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
        Schema::create('recipe_user', function (Blueprint $table) {
            $table->primary(['user_id', 'recipe_id']);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('recipe_id')->unsigned();

            $table->foreign('user_id', 'recipe_userTable_userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('recipe_id', 'recipe_userTable_recipeId')->references('id')->on('recipes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_user');
    }
};
