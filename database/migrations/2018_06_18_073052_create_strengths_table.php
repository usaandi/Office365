<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStrengthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strengths', function (Blueprint $table) {
            $table->increments('id');
            $table->text('strength_description')->nullable();
            $table->text('strength_name');
            $table->text('icon')->nullable();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->text('category_name');
            $table->text('category_description')->nullable();
            $table->text('category_colour');
            $table->timestamps();
        });

        Schema::create('strengths_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('strength_id');
            $table->text('category_description')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('strength_id')->references('id')->on('strengths')->onDelete('cascade');
        });

        schema::create('users_strengths', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('strength_id');
            $table->unsignedInteger('user_id');
            $table->integer('rank');
            $table->timestamps();

            $table->foreign('strength_id')->references('id')->on('strengths')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('strengths');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('strengths_categories');
        Schema::dropIfExists('users_strengths');
    }
}
