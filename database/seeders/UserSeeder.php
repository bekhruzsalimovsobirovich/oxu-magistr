<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'student'
        ]);
        $user = new User();
        $user->name = 'admin';
        $user->login = 'admin';
        $user->password = Hash::make('magistr2024');
        $user->save();
        $user->assignRole('admin');
    }
}
