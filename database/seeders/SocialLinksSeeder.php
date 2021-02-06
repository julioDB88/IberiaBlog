<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $links=[
            ['name'=>'twitter','url'=>'none','active'=>0],
            ['name'=>'facebook','url'=>'none','active'=>0],
            ['name'=>'instagram','url'=>'none','active'=>0],
            ['name'=>'youtube','url'=>'none','active'=>0]
        ];
        DB::table('social_links')->insert($links);
    }
}
