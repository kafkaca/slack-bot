<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'Admin', 
            'slug' => 'admin',
            'permissions' => [
                'see_all_vacations' => true,
                'see_all_employees' => true,
                'create_post' => true,
                'update_post' => true,
                'publish_post' => true
            ]
        ]);

        $employee = Role::create([
            'name' => 'Employee', 
            'slug' => 'employee',
            'permissions' => [
                'update_post' => true,
                'publish_post' => true
            ]
        ]);
    }
}
