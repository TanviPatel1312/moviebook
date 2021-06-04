<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'is_admin'=>'1',
            'password'=> bcrypt('12345'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);

    }
}
