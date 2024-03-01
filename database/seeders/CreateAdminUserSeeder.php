<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'=>'Youssef Refaey',
            'email'=>'youcofrefaey@gmail.com',
            'roles_name' => ['owner'],
            'Status' => 'مفعل',
            'password'=> Hash::make('12345678')
        ]);

        $role = Role::create(['name' => 'owner']);

        $permissions = Permission::pluck('id','id')->all();
        
        $role->syncPermissions($permissions);
        
        $user->assignRole([$role->id]);

    }
}
