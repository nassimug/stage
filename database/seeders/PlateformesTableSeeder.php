<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlateformesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('plateformes')->insert([
            [
                'nom' => 'Plateforme Terrestre',
                'type' => 'Terrestre',
                'description' => 'Description de la plateforme terrestre',
                'capacite' => 'Capacité de la plateforme terrestre',
            ],
            [
                'nom' => 'Plateforme Drone',
                'type' => 'Drone',
                'description' => 'Description de la plateforme drone',
                'capacite' => 'Capacité de la plateforme drone',
            ]
        ]);
    }
}
