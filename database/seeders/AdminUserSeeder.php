<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'sortiqsolution@gmail.com'],
            [
                'name' => 'Sortiq Admin',
                'password' => Hash::make('sortiq'),
            ],
        );
    }
}
