<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=1; $i<=50; $i++){
            DB::table('posts')->insert([
                'user_id' => mt_rand(1, 5),
                'title' => 'test'. $i,
                'body' => 'test'. $i,
                'post_type' => mt_rand(1, 2),
                'stance' => mt_rand(1, 4),
                'part_1' => mt_rand(1, 8),
                'part_2' => mt_rand(1, 8),
                'part_3' => mt_rand(1, 8),
                'part_4' => mt_rand(1, 8),
                'part_5' => mt_rand(1, 8),
                'part_6' => mt_rand(1, 8),
                'part_7' => mt_rand(1, 8),
                'part_8' => mt_rand(1, 8),
                'area_1' =>  mt_rand(1, 48),
                'area_2' =>  mt_rand(1, 48),
                'area_3' =>  mt_rand(1, 48),
                'area_4' =>  mt_rand(1, 48),
                'area_5' =>  mt_rand(1, 48),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
