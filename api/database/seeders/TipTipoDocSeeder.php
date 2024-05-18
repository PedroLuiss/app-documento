<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;


class TipTipoDocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'tip_nombre' => 'Instructivo',
                'tip_prefijo'=>"INS",
            ],
            [
                'tip_nombre' => 'Activo',
                'tip_prefijo'=>"ACT",
            ],
            [
                'tip_nombre' => 'INACTIVO',
                'tip_prefijo'=>"INAC",
            ],
            [
                'tip_nombre' => 'OMEGA',
                'tip_prefijo'=>"OMG",
            ],
            [
                'tip_nombre' => 'Organización',
                'tip_prefijo'=>"ORN",
            ],

        ];
          DB::table('tip_tipo_docs')->insert($data);
    }
}
