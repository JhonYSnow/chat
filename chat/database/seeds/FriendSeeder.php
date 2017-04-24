<?php

use Illuminate\Database\Seeder;

class FriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('friends')->delete();

        for($i=0; $i < 10; $i++){
            \App\Friend::create([
                'user1' => $i,
                'user2' => $i+1,
            ]);
        }
    }
}
