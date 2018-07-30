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
        /*Schema::create('users_departments', function (Blueprint $table){
            $table->integer('department_id');
            $table->integer('user_id');
            $table->timestamp('closed_at');
            $table->timestamps();

            $table->foreign('department_id')->references('departments')->on('id');
            $table->foreign('user_id')->references('users')->on('id');

        });*/

        /*Schema::create('teams_departments', function (Blueprint $table){
            $table->integer('department_id');
            $table->integer('team_id');
            $table->timestamp('closed_at');
            $table->timestamps();
            $table->primary(['department_id', 'team_id']);

            $table->foreign('team_id')->references('teams')->on('id');
            $table->foreign('user_id')->references('users')->on('id');
        });*/

        Schema::create('departments', function (Blueprint $table){
           $table->increments('id');
           $table->string('department_name');
           $table->string('department_abbr');
           $table->text('department_info');
           $table->timestamps();
        });

        Schema::create('teams', function (Blueprint $table){
           $table->increments('id');
           $table->string('team');
           $table->timestamps();
        });

        Schema::create('users_departments', function (Blueprint $table){
            $table->integer('department_id');
            $table->integer('user_id');
            $table->timestamp('closed_at');
            $table->timestamps();

            $table->foreign('department_id')->references('departments')->on('id');
            $table->foreign('user_id')->references('users')->on('id');

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
        Schema::dropIfExists('users_departments');
        schema::dropIfExists('teams');
        schema::dropIfExists('teams_departments');
    }
}
