<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Employee;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
		])
		->employee()
		->create([])
		->vacations()
		->create([]);

        $employee = User::create([
		])
		->employee()
		->create([])
		->vacations()
		->create([]);
    }
}
