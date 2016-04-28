<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        require_once(__DIR__ . '/BreedsTableSeeder.php');
        $this->call('BreedsTableSeeder');
    }
}
