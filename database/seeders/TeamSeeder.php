<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Teams')->insert(array(
            array(
            'name' => "Umum",
            ),
            array(
            'name' => "Proksi",
            ),
            array(
            'name' => "D-JAS",
            ),
            array(
            'name' => "D-SOSPRO",
            ),
            array(
            'name' => "NEON",
            ),
            array(
            'name' => "DILAN",
            ),
            array(
            'name' => "ST2023",
            ),
            array(
            'name' => "SDI",
            ),
            array(
            'name' => "POTIK",
            ),
            array(
            'name' => "RB-ZI",
            ),
            array(
            'name' => "DESA CANTIK",
            ),
            array(
            'name' => "IPS",
            ),
            array(
            'name' => "SAKIP",
            ),
            array(
            'name' => "HUMAS",
            ),

            ));
             
            
    }
}
