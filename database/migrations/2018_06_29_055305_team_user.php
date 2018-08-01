<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TeamUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('teams', function (Blueprint $table){
            $table->increments('id');
            $table->string('team');
            $table->timestamps();
        });

        Schema::create('departments', function (Blueprint $table){
           $table->increments('id');
           $table->string('department_name');
           $table->string('department_abbr');
           $table->text('department_info');
           $table->timestamps();
        });

        Schema::create('users_departments', function (Blueprint $table){
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('departments_teams', function (Blueprint $table){
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('team_id');
            $table->softDeletes();
            $table->timestamps();
            $table->primary(['department_id', 'team_id']);

            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('department_id')->references('id')->on('departments');
        });

        Schema::create('users_teams', function (Blueprint $table){
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('user_id')->references('id')->on('users');

        });

        Schema::create('teams_moderators', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists('teams');
        Schema::dropIfExists('departments');

        schema::dropIfExists('users_teams');
        Schema::dropIfExists('users_departments');

        schema::dropIfExists('departments_teams');
        schema::dropIfExists('teams_moderators');

    }
}
