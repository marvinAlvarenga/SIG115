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

        
        DB::insert('insert into roles (id, name, slug) values (?, ?,?)', [1, 'Administrador','admin  ']);
        DB::insert('insert into roles (id, name, slug) values (?, ?,?)', [2, 'Estratégico','est']);
        DB::insert('insert into roles (id, name, slug) values (?, ?,?)', [3, 'Táctico','tac']);
        
    }
}
