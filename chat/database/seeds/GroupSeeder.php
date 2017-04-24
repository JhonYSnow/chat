<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('groups')->delete();

        for($i=0; $i < 10; $i++){
            \App\Group::create([
                'name' => ($i%2)."组",
                'user' => $i,
            ]);
        }
    }
}
