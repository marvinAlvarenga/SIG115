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
        $this->call(DepartmentTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(SpareTableSeeder::class);
        $this->call(UpkeepTableSeeder::class);
        $this->call(LicenceTableSeeder::class);
        $this->call(ProductLicenceTableSeeder::class);
        // $this->call(UserTableSeeder::class);
        // $this->call(PermissionsTableSeeder::class);
    }
}

