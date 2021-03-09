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
         ['name'=>'about','content'=>'null'],
         ['name'=>'Contact','content'=>'null'],
         ['name'=>'Shop','content'=>'null'],
         ['name'=>'Videos','content'=>'null'],
     ];
        DB::table('pages_content')->insert($content); //
    }
}
