<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $content=[
         ['page'=>'about','content'=>'null'],
         ['page'=>'contact','content'=>'null'],
         ['page'=>'shop','content'=>'null'],
         ['page'=>'videos','content'=>'null'],
     ];
        DB::table('pages_content')->insert($content); //
    }
}
