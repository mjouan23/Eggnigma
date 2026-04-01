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
            [
                'code' => 'ZJRVW',
                'title' => 'Chasse secrète',
                'clue' => 'Je suis un code unique de cinq lettres pour éviter les triches. Où suis-je utilisé ?',
                'hint' => '',
                'answer' => 'Dans l\'adresse du QR Code',
            ],  
            [
                'code' => 'QZLPA',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
            ],  
            [
                'code' => 'MVXTR',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
            ],  
            [
                'code' => 'KJHDU',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
            ],  
            [
                'code' => 'RYFNB',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
            ],  
            [
                'code' => 'TPCWO',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
            ],  
            [
                'code' => 'BGLSA',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
            ],  
            [
                'code' => 'NEXIV',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
            ],  
            [
                'code' => 'DQRMK',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
            ],  
            [
                'code' => 'HZUPY',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
            ],  
            [
                'code' => 'CJWLA',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
            ],  
            [
                'code' => 'FOTGN',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
            ],  
            [
                'code' => 'XBKER',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
            ],  
            [
                'code' => 'VSMQI',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
            ],  
            [
                'code' => 'PLKQZ',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
            ],  
            [
                'code' => 'UYVTR',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
            ],  
            [
                'code' => 'MEGXA',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
            ]
        ];

        DB::table('eggs')->truncate();

        foreach ($eggs as &$egg) {
            $egg['created_at'] = now();
            $egg['updated_at'] = now();
        }

        DB::table('eggs')->insert($eggs);
    }
}
