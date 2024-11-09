<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Enum\UserRole;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (UserRole::cases() as $role) { 
            if (!Role::where('name', $role->name)->exists()) {
                Role::create(['name' => $role->value]);
            }
        }
    }
}