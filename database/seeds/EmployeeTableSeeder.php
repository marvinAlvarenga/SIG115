<?php

use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Employee::class,30)->create();

        App\User::create([
            'name'=> 'Administrador',
            'email'=> 'admin@ues.com',
            'password'=> bcrypt('1234'),

        ]);
    }
}