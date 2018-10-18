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

            $table->foreign('career_role_id')->references('id')->on('career_roles')->onDelete('cascade');
        });

        Schema::create('users_career_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('career_role_id');
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->text('description');
            $table->boolean('current_role')->nullable();
            $table->timestamps();

            $table->foreign('career_role_id')->references('id')->on('career_roles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('users_career_roles_milestones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('milestone_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('assigned_id')->nullable();
            $table->unsignedInteger('user_career_role_id')->nullable();
            $table->text('task')->nullable();
            $table->date('reminder')->nullable();
            $table->boolean('completed')->nullable();
            $table->timestamps();

            $table->foreign('milestone_id')->references('id')->on('career_roles_milestones')->onDelete('cascade');
            $table->foreign('assigned_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_career_role_id')->references('id')->on('users_career_roles')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     */
    public function down()
    {
        Schema::dropIfExists('career_roles');
        Schema::dropIfExists('career_roles_milestones');
        Schema::dropIfExists('users_career_roles');
        Schema::dropIfExists('users_career_roles_milestones');
    }
}
