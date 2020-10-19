<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=1; $i<=5; $i++) {
            DB::table('users')->insert([
                'name' => 'user' . $i,
                'email' => 'sample' . $i .'@sample.com',
                'password' => bcrypt('byjsx117'),
                'birth_day' => '1995/03/10',
                'gender' => mt_rand(1, 2),
                'residence' => mt_rand(1, 48),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
