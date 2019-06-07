<?php

use Illuminate\Database\Seeder;

class UpkeepTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Upkeep::class,30)->create();
    }
}
