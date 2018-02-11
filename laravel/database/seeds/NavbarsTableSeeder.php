<?php

use Illuminate\Database\Seeder;

class NavbarsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('navbars')->insert(
            require_once __DIR__ . '/data/navbars.php'
        );
    }

}
