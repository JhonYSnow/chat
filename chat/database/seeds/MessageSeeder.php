<?php

use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('messages')->delete();

        for($i=0; $i < 10; $i++){
            \App\Messages::create([
               'mes' => 'Message'.$i,
                'user1' => 1,
                'user2' => 2,
                'mes_type' => 1,
                'send_time' => date("Y/m/d"),
            ]);
        }
    }
}
