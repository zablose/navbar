<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavbarsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('navbars')->insert(
            require_once __DIR__.'/data/navbars.php'
        );
    }
}
