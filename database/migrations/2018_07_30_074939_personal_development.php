<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersonalDevelopment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        Schema::create('developments', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('milestone_id');
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('user_development', function (Blueprint $table) {

            $table->integer('development_id');
            $table->integer('user_id');
            $table->timestamps();

            $table->foreign('development_id')->references('development')->on('id');
            $table->foreign('user_id')->references('users')->on('id');
        });


        Schema::create('milestones', function (Blueprint $table) {

            $table->increments('id');
            $table->text('task');
            $table->text('assigned');
            $table->date('reminder');
            $table->boolean('completed');
            $table->timestamps();
        });




    }
    /**
     * Reverse the migrations.
     *
     */
    public function down()
    {
        Schema::dropIfExists('developments');
        Schema::dropIfExists('milestones');
        Schema::dropIfExists('user_development');
    }
}
