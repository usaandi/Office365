<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@adm.com',
            'token' => str_random(1000),

        ]);
    }
}
