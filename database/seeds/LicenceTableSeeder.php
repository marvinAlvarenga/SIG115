<?php

use Illuminate\Database\Seeder;

class LicenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Licence::class,10)->create();
    }
}
