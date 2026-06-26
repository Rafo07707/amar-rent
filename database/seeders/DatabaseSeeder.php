<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            LocationSeeder::class,
            CarSeeder::class,
            ExtraSeeder::class,
            PageSeeder::class,
            FaqSeeder::class,
        ]);
    }
}
