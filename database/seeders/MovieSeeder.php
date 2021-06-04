<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10)as $index){
            DB::table('movies')->insert([
                'title'=>$faker->sentence(5),
                'overview' => $faker->paragraph(1),
                'releaseyear'=> $faker->year(4),
                'runtime'=>$faker->time('H:i:s',10),

            ]);
        }

    }
}
