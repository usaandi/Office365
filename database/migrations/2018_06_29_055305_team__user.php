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
        schema::create('users_teams', function (Blueprint $table){
            $table->integer('team_id');
            $table->integer('user_id');
            $table->timestamp('closed_at');
            $table->timestamps();
            $table->primary(['team_id', 'user_id']);

        });

        schema::create('teams', function (Blueprint $table){
           $table->increments('id');
           $table->string('team_name');
           $table->string('team_abbr');
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
        schema::dropIfExists('teams');
        Schema::dropIfExists('users_teams');
    }
}
