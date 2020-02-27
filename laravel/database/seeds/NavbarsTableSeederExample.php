<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavbarsTableSeederExample extends Seeder
{
    public function run(): void
    {
        DB::table('navbars')->insert(
            require_once __DIR__.'/data/navbars.php'
        );
    }
}
