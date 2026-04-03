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
                'code' => 'LQXPD',
                'title' => 'Code César',
                'clue' => 'mrbhxvhv ĥwh gh sd̂txhv',
                'hint' => '+3',
                'answer' => 'joyeuse fête de pâques',
                'image' => '',
            ],
            [
                'code' => 'KJHDU',
                'title' => 'Chiffre',
                'clue' => 'Quel chiffre vient à la place du point d\'interrogation ?',
                'hint' => '',
                'answer' => '0',
                'image' => '/images/eggs/kjhdu.png',
            ],  
            [
                'code' => 'HZUPY',
                'title' => 'Combien d\'enfants ?',
                'clue' => '<p>Quatorze des enfants de la son des filles.</p><p>Huit des enfants portent des chemises bleues. Deux des enfants ne sont pas des filles et ne portent pas de chemises bleues.</p><p>Si cinq des enfants sont des filles portant des chemises bleues, combien d\'enfants y a-t-il dans la classe ?</p>',
                'hint' => 'Il y a 3 garçons qui portent des chemises bleues.',
                'answer' => '19',
                'image' => '',
            ],
            [
                'code' => 'DQRMK',
                'title' => 'Une série en rythme',
                'clue' => '<p>D R M F S L S...?</p><p>Quelle est la prochaine lettre de la série ?</p>',
                'hint' => '',
                'answer' => 'D',
                'image' => '',
            ],  
            [
                'code' => 'FOTGN',
                'title' => 'Bouuuuge !',
                'clue' => '<p>Le savoir ne vient pas toujours au repos.</p><p>Certains secrets refusent le calme et n\'apparaissent que lorsque le monde tremble un instant.</p><p>Si rien ne se passe, c\'est peut-être que tu es trop immobile.</p>',
                'hint' => '',
                'answer' => 'poule',
                'image' => '',
            ],  
            [
                'code' => 'CJWLA',
                'title' => 'Suite ou pas !',
                'clue' => 'Par quoi doit être remplacé le point d\'interrogation ?',
                'hint' => 'R',
                'answer' => '',
                'image' => '/images/eggs/cjwla.png',
            ],  
            [
                'code' => 'BKMFR',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
                'image' => '',
            ],  
            [
                'code' => 'BGLSA',
                'title' => 'La bombonne d\'eau',
                'clue' => 'Une bonbonne d\'eau est presque vide, mais son volume double chaque jour. Il faut 60 jours pour qu\'elle soit complètement remplie. Combien de jours faut-il pour qu\'elle soit à moitié pleine ?',
                'hint' => 'indiquer que le nombre de jours sans le mot jour',
                'answer' => '59',
                'image' => '',
            ],  
            [
                'code' => 'MEGXA',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
                'image' => '',
            ],  
            [
                'code' => 'MVXTR',
                'title' => 'Inverse et décalé ',
                'clue' => '<p>On a codé un mot :</p><ul><li>Inversé</li><li>Décalé chaque lettre de +1</li></ul><div>Résultat : <strong>ojqbm</strong></div>',
                'hint' => '',
                'answer' => 'lapin',
                'image' => '',
            ],  
            [
                'code' => 'NEXIV',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
                'image' => '',
            ],  
            [
                'code' => 'PLKQZ',
                'title' => 'Gardiens',
                'clue' => 'Plus j\'ai de gardiens, moins je suis gardé. Qui suis-je ?',
                'hint' => 'Réponse sans article',
                'answer' => 'secret',
                'image' => '',
            ],  
            [
                'code' => 'QZLPA',
                'title' => 'Observe !',
                'clue' => '<p>L\'œuf n\'offre jamais son trésor au premier regard.</p><p>Celui qui se contente de l\'apparence repart les mains vides.</p><p>Celui qui ose trahir la façade découvre ce qui était gardé.</p>',
                'hint' => '',
                'answer' => 'cloche',
                'image' => '',
            ],  
            [
                'code' => 'RDNOC',
                'title' => 'Le calcul',
                'clue' => '<p>86608 + 80181 = 90166</p><p>66189 + 69661 = ?</p>',
                'hint' => '',
                'answer' => '88168',
                'image' => '',
            ],  
            [
                'code' => 'RYFNB',
                'title' => 'Triangles',
                'clue' => 'Combien de triangles vois-tu ?',
                'hint' => '',
                'answer' => '6',
                'image' => '/images/eggs/ryfnb.png',
            ],  
            [
                'code' => 'TPCWO',
                'title' => 'Menteur !',
                'clue' => '<p>Raphaël, Julien et Émile se disputent.</p><p>Raphaël dit que Julien ment.</p><p>Julien dit qu\'Émile ment.</p><p>Émile dit que Raphaël et Julien mentent".</p><p>Lesquels dit la vérité ?</p>',
                'hint' => 'Si Raphaël dit la vérité, alors l\'affirmation de Julien selon laquelle Émile ment serait un mensonge.',
                'answer' => 'Julien',
            ],
            [
                'code' => 'VSMQI',
                'title' => 'J\'ai les dents',
                'clue' => 'Qu\'est-ce qui a des dents, mais ne mange pas ?',
                'hint' => 'Réponse sans article',
                'answer' => 'peigne',
                'image' => '',
            ],  
            [
                'code' => 'XBKER',
                'title' => 'Le nombre mystère',
                'clue' => 'Quel numéro se chache derrière ce point d\'interrogation ?',
                'hint' => '',
                'answer' => '87',
                'image' => '/images/eggs/xbker.png',
            ],  
            [
                'code' => 'ZJRVW',
                'title' => '',
                'clue' => '',
                'hint' => '',
                'answer' => '',
                'image' => '',
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
