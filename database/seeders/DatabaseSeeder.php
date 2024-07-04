<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Data dummy users
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Fatha',
            'email' => 'aa@bb.cc',
            'username' => 'fatha12',
            'password' => Hash::make('123'), // Enkripsi password
            'role' => 'admin',
            
        ]);

        User::factory()->create([
            'name' => 'belly',
            'email' => 'belly@mail.com',
            'username' => 'bella12',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);

        // Data dummy employees
        Employee::factory()->create([
            'name' => 'belly',
            'nip' => '123456789',
            'birthplace' => 'jakarta',
            'birthdate' => '1999-12-12',
            'phone' => '08123456789',
            'address' => 'jl.abc',
        ]);
    }
}
