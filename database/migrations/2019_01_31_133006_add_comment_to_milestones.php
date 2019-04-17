<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentToMilestones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_career_roles_milestones', function ($table) {
            $table->text('description')->nullable();
        });

        Schema::table('career_roles_milestones', function ($table) {
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_career_roles_milestones', function ($table) {
            $table->dropColumn('description');
        });
        Schema::table('career_roles_milestones', function ($table) {
            $table->dropColumn('description');
        });
    }
}
