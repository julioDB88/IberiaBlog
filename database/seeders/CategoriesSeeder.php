<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats =[
            ['name'=>'national','slug'=>'national'],
            ['name'=>'international','slug'=>'international'],
            ['name'=>'misc','slug'=>'misc'],

        ];
        DB::table('categories')->insert($cats);


    }
}
