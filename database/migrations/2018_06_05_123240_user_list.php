<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id');
            $table->string('email')->unique();
            $table->integer('phone')->nullable();
            $table->string('name');
            $table->date('birthday')->nullable();
            $table->string('skype')->nullable();
            $table->string('description')->nullable();
            $table->date('ADMsince')->nullable();
            $table->string('pictureLocation')->nullable();
            $table->softDeletes('deleted_at');
            $table->longText('token');
            $table->rememberToken();
            $table->timestamps();
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
