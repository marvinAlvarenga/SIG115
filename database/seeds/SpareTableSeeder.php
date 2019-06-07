<?php

use Illuminate\Database\Seeder;

class SpareTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Spare::class,30)->create();
    }
}
