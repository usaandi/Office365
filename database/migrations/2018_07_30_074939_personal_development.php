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
        Schema::create('career_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('career_roles_milestones', function (Blueprint $table) {
            $table->increments('id');
            $table->text('task');
            $table->unsignedInteger('career_role_id');
            $table->timestamps();

            $table->foreign('career_role_id')->references('id')->on('career_roles');
        });

        Schema::create('users_career_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('career_role_id');
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->text('description');
            $table->timestamps();

            $table->foreign('career_role_id')->references('id')->on('career_roles');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('users_career_roles_milestones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('milestone_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('assigned_id');
            $table->text('task');
            $table->date('reminder');
            $table->boolean('completed');
            $table->timestamps();

            $table->foreign('milestone_id')->references('id')->on('career_roles_milestones');
            $table->foreign('assigned_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
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
