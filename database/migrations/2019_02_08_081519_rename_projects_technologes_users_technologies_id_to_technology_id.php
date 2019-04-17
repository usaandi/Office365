<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameProjectsTechnologesUsersTechnologiesIdToTechnologyId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects_technologies_users', function (Blueprint $table) {
            $table->renameColumn('technologies_id', 'technology_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects_technologies_users', function (Blueprint $table) {
            $table->renameColumn('technology_id', 'technologies_id');
        });
    }
}
