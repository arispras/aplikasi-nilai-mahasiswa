<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            JurusanSeeder::class,
            MataKuliahSeeder::class,
            MahasiswaSeeder::class,
            AdminUserSeeder::class,
            NilaiSeeder::class,
        ]);
    }
}