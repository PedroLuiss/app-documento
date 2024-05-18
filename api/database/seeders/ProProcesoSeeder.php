<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;


class ProProcesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'pro_prefijo' => 'ING',
                'pro_nombre'=>"Ingeniería",
            ],
            [
                'pro_prefijo' => 'LIC',
                'pro_nombre'=>"Licenciatura",
            ],
            [
                'pro_prefijo' => 'MED',
                'pro_nombre'=>"Medicina",
            ],
            [
                'pro_prefijo' => 'ARQ',
                'pro_nombre'=>"Arquitectura",
            ],
            [
                'pro_prefijo' => 'CON',
                'pro_nombre'=>"Contabilidad",
            ],
            [
                'pro_prefijo' => 'DER',
                'pro_nombre'=>"Derecho",
            ]

        ];
          DB::table('pro_procesos')->insert($data);
    }
}
