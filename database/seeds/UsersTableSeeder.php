<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     *  We generate a number of users (see readme) and various workgroups for them
     *  to belong to.
     */
    public function run(): void
    {
        $users = DB::table('users');

        $users->insert([
            'name' => 'Ryan',
            'email' => 'ryanrapini@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
