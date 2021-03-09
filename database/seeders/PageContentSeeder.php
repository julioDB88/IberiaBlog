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
         ['page'=>'Conócenos','content'=>'null'],
         ['page'=>'Contact','content'=>'null'],
         ['page'=>'Shop','content'=>'null'],
         ['page'=>'Videos','content'=>'null'],
     ];
        DB::table('pages_content')->insert($content); //
    }
}
