<?php

use \Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UsersSeeder extends Seeder
{
    public function run()
    {
        $company_id = DB::table('companies')->insertGetId([
            'name' => 'Griffon Technologies',
        ]);

        DB::table('users')->delete();

        DB::table('users')->insert([
            'name' => 'Omebe Johnbosco',
            /*'username' => 'admin',*/
            'email' => 'admin@localhost.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now(),
            'company_id' => $company_id
        ]);

    }

}
