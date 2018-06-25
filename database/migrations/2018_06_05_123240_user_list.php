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
            $table->integer('phoneN');
            $table->string('name');
            $table->date('birthday');
            $table->string('skype');
            $table->string('team');
            $table->string('description');
            $table->date('ADMsince');
            $table->string('pictureLocation');

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
        Schema::dropIfExists('strength_user');
    }
}
