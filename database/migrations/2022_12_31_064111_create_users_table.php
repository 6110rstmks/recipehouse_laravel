<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('pricing_plan')->default(0)->comment('有料会員');
            $table->integer('point')->default(500)->comment('所有ポイント');
            $table->tinyInteger('locked_flg')->default(0);
            $table->integer('error_count')->unsigned()->default(0);
            $table->integer('auth_code')->nullable()->comment('auth_code for password resetting');
            $table->string('expiration')->nullable()->comment('trash_expiration_date');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
