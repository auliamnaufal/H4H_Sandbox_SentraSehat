<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $role = new Role();
        $role->role = 'admin';
        $role->save();
        $permission = new Permission();
        $permission->permission = 'create-user';
        $permission->save();
        $role->permissions()->attach($permission);
        // $permission->roles()->attach($role);

        $role = new Role();
        $role->role = 'doctor';
        $role->save();
        $permission = new Permission();
        $permission->permission = 'create-diagnosis';
        $permission->save();
        $role->permissions()->attach($permission);
        // $permission->roles()->attach($role);

        $admin = Role::where('role', 'admin')->first();
        $doctorRole = Role::where('role', 'doctor')->first();
        $create_post = Permission::where('permission', 'create-post')->first();
        $create_diagnosis = Permission::where('permission', 'create-diagnosis')->first();

        // $admin = new User();
        // $admin->name = 'Admin';
        // $admin->email = 'admin@gmail.com';
        // $admin->password = bcrypt('admin');
        // $admin->save();

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
        ]);
        $admin->roles()->attach($admin);
        $admin->permissions()->attach($create_post);

        // $doctor = new User();
        // $doctor->name = 'Doctor';
        // $doctor->email = 'doctor@gmail.com';
        // $doctor->password = bcrypt('doctor');
        // $doctor->save();

        $doctor = User::factory()->create([
            'name' => 'doctor',
            'email' => 'doctor@gmail.com',
        ]);
        $doctor->roles()->attach($doctorRole);
        $doctor->permissions()->attach($create_diagnosis);
    }
}
