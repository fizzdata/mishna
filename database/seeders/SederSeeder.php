<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SederSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('seder')->insert([
            ['name' => 'זרעים'],
            ['name' => 'מועד'],
            ['name' => 'נשים'],
            ['name' => 'נזיקין'],
            ['name' => 'קדשים'],
            ['name' => 'טהרות'],
            
        ]);
    }
}
