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
            $table->integer('milestone_id')->unsigned();
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('milestones', function (Blueprint $table) {
            $table->increments('id');
            $table->text('task');
            $table->integer('assigned_id');
            $table->date('reminder');
            $table->boolean('completed');
            $table->timestamps();
        });

        Schema::create('users_development', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('development_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('development_id')->references('id')->on('developments');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('development_milestone', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('development_id');
            $table->unsignedInteger('milestone_id');
            $table->timestamps();
            $table->foreign('development_id')->references('id')->on('developments');
            $table->foreign('milestone_id')->references('id')->on('milestones');
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
        Schema::dropIfExists('development_milestone');
    }
}
