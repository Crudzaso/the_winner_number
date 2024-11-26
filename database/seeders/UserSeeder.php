<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Juan David Zapata Barrera',
            'email' => 'AdminTheWinnerNumber@Gmail.com',
            'password' => bcrypt('TheWinner'),
        ]);
        $user->assignRole('admin');

        $user2 = User::create([
            'name' => 'samuel zapata barrera',
            'email' => 'samuel@Gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole('organizer');
        
    }
}
