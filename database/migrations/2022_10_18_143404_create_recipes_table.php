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
        Schema::create('recipes', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('body')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('tag_id')->unsigned()->nullable();
            $table->string('file_path')->nullable();
            $table->string('expiration')->nullable()->comment('trash_expiration_date');
            $table->integer('view')->default(0)->comment('counting page view');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
};
