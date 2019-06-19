<?php

use Illuminate\Database\Seeder;

class ProductLicenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('product_licence')->insert([
        'product_id'  => '2',
        'licence_id'   => '1    ',
        ]);

        DB::table('product_licence')->insert([
            'product_id'  => '2',
            'licence_id'   => '2',
           ]);

        DB::table('product_licence')->insert([
        'product_id'  => '3',
        'licence_id'   => '1',
        ]);

        DB::table('product_licence')->insert([
        'product_id'  => '4',
        'licence_id'   => '1',
        ]);

        DB::table('product_licence')->insert([
        'product_id'  => '5',
        'licence_id'   => '1',
        ]);

        DB::table('product_licence')->insert([
        'product_id'  => '5',
        'licence_id'   => '5',
        ]);

        DB::table('product_licence')->insert([
            'product_id'  => '5',
            'licence_id'   => '4',
            ]);

        DB::table('product_licence')->insert([
        'product_id'  => '15',
        'licence_id'   => '4',
        ]);

        DB::table('product_licence')->insert([
        'product_id'  => '9',
        'licence_id'   => '6',
        ]);

        DB::table('product_licence')->insert([
        'product_id'  => '8',
        'licence_id'   => '1',
        ]);
        DB::table('product_licence')->insert([
        'product_id'  => '9',
        'licence_id'   => '7',
        ]);
        DB::table('product_licence')->insert([
        'product_id'  => '12',
        'licence_id'   => '7',
        ]);
    }
}
