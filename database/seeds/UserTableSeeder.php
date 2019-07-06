<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'=> 'Julio Paredes',
            'email'=> 'julio.paredes@ues.edu.sv',
            'password'=> bcrypt('adminpa01*'),

        ]);
   
        App\User::create([
            'name'      =>  'Javier Pérez',
            'email'     =>  'javier.perez@ues.edu.sv',
            'password'  =>  bcrypt('gerenpe01*'),
        ]);

        App\User::create([
            'name'      =>  'Aarón Rosales',
            'email'     =>  'aaron.rosales@ues.edu.sv',
            'password'  =>  bcrypt('tactiro01*'),
        ]);
        
        factory(App\User::class,7)->create();
    }
}
