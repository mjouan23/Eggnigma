<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EggSeeder extends Seeder
{
    public function run()
    {
        $eggs = [
            [
                'code' => 'BKMFR',
                'title' => 'Code César',
                'clue' => 'mrbhxvhv ĥwh gh sd̂txhv',
                'hint' => '+3',
                'answer' => 'joyeuses fête de pâques',
            ],
            [
                'code' => 'LQXPD',
                'title' => 'Énigme du lapin',
                'clue' => 'Je saute et je distribue des œufs, qui suis-je ?',
                'hint' => '',
                'answer' => 'Le lapin de Pâques',
            ],  
            [
                'code' => 'ZJRVW',
                'title' => 'Chasse secrète',
                'clue' => 'Je suis un code unique de cinq lettres pour éviter les triches. Où suis-je utilisé ?',
                'hint' => '',
                'answer' => 'Dans l\'adresse du QR Code',
            ],
        ];

        DB::table('eggs')->truncate();

        foreach ($eggs as &$egg) {
            $egg['created_at'] = now();
            $egg['updated_at'] = now();
        }

        DB::table('eggs')->insert($eggs);
    }
}
