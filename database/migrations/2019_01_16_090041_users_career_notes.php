<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersCareerNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->unsignedInteger('user_career_role_id');
            $table->unsignedInteger('assigner_id');
            $table->timestamps();
            $table->foreign('user_career_role_id')->references('id')->on('users_career_roles')->onDelete('cascade');
            $table->foreign('assigner_id')->references('id')->on('users')->onDelete('cascade');


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists('notes');
    }
}
