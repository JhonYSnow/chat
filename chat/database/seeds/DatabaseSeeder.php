<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(FriendSeeder::class);
        $this->call(GroupSeeder::class);
    }
}
