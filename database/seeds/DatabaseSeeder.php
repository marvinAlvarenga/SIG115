<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(PermissionsTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(SpareTableSeeder::class);
        $this->call(UpkeepTableSeeder::class);
    }
}
