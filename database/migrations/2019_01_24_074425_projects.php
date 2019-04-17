<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Projects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->string('project_title');
            $table->text('description');
            $table->date('begin_date');
            $table->date('end_date')->nullable();
            $table->timestamps();

        });

        Schema::create('clients', function (Blueprint $table) {

            $table->increments('id');
            $table->string('client_name');
            $table->timestamps();

        });
        Schema::create('positions', function (Blueprint $table) {

            $table->increments('id');
            $table->string('position_name');
            $table->timestamps();

        });

        Schema::create('clients_projects', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('project_id');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

        });


        Schema::create('projects_users_positions', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('position_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');

        });

        Schema::create('technologies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('technology_name');
        });

        Schema::create('technologies_users', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('technologies_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('technologies_id')->references('id')->on('technologies')->onDelete('cascade');

        });
        Schema::create('projects_technologies_users', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('technologies_id');
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('technologies_id')->references('id')->on('technologies')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
