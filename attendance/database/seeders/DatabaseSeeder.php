<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

        User::factory()->create([
            'role' => 'admin',
            'name' => 'superadmin',
            'email' => 'amigo.marieneth@gmail.com',
            'password' => 'Sup3r@dm1n',
        ]);

        User::factory()->create([
            'role' => 'admin',
            'name' => 'cm_nikki',
            'email' => 'nadmardoquio13@gmail.com',
            'password' => 'C@mpu5Go',
        ]);

        User::factory()->create([
            'role' => 'admin',
            'name' => 'pastor_dennis',
            'email' => 'dennis.mardoquio@victory.org.ph',
            'password' => 'Pl@nt&6row',
        ]);

        User::factory()->create([
            'role' => 'student',
            'name' => 'bea_carido',
            'email' => 'beacarido806@gmail.com',
            'password' => 'Stud3ntL3@d3r',
        ]);
    }
}
