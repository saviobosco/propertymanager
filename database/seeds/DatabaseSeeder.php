<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->command->info('Seeded the Users!');
        $this->call(PropertiesSeeder::class);
        $this->command->info('Seeded the Properties!');
    }
}
