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
        Schema::create('post_task', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('post_id')->unsigned();
            $table->bigInteger('task_id')->unsigned();

            $table->foreign('task_id', 'pivotTable_taskId')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('post_id', 'pivotTable_postId')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_task');
    }
};
