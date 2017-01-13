<?php
/**
 * Author: darluc
 * Date: 4/27/16
 * Time: 14:10
 */
use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create(['username' => 'admin', 'password' => bcrypt('hunter2'), 'is_admin' => true,]);
        User::create(['username' => 'scott', 'password' => bcrypt('tiger'), 'is_admin' => false,]);
    }
}