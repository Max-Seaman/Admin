<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);

        Company::factory(100)->create()->each(function ($company) {
            // Create an amount of employees for each company created
            Employee::factory(rand(1, 20))->create([
                'company_id' => $company->id,
            ]);
        });
    }
}
