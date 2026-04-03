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
                'clue' => '<p>mrbhxvhv ĥwh gh sd̂txhv</p><p>Quel est le message caché ?</p>',
                'hint' => '+3',
                'answer' => 'Joyeuse fête de pâques',
                'image' => '',
                'information' => '',
            ],
            [
                'code' => 'KJHDU',
                'title' => 'Chiffre mystère',
                'clue' => '<p>Quel chiffre vient à la place du point d\'interrogation ?</p>',
                'hint' => '',
                'answer' => '0',
                'image' => '/images/eggs/kjhdu.png',
                'information' => '',
            ],  
            [
                'code' => 'HZUPY',
                'title' => 'Combien d\'enfants ?',
                'clue' => '<p>Quatorze des enfants de la son des filles.</p><p>Huit des enfants portent des chemises bleues. Deux des enfants ne sont pas des filles et ne portent pas de chemises bleues.</p><p>Si cinq des enfants sont des filles portant des chemises bleues, combien d\'enfants y a-t-il dans la classe ?</p>',
                'hint' => 'Il y a 3 garçons qui portent des chemises bleues.',
                'answer' => '19',
                'image' => '',
                'information' => '',

            ],
            [
                'code' => 'DQRMK',
                'title' => 'Une série en rythme',
                'clue' => '<p>D R M F S L S...?</p><p>Quelle est la prochaine lettre de la série ?</p>',
                'hint' => '',
                'answer' => 'D',
                'image' => '',
                'information' => '',
            ],  
            [
                'code' => 'FOTGN',
                'title' => 'Bouuuuge !',
                'clue' => '<p>Le savoir ne vient pas toujours au repos.</p><p>Certains secrets refusent le calme et n\'apparaissent que lorsque le monde tremble un instant.</p><p>Si rien ne se passe, c\'est peut-être que tu es trop immobile.</p>',
                'hint' => '',
                'answer' => 'poule',
                'image' => '',
                'information' => '',
            ],  
            [
                'code' => 'CJWLA',
                'title' => 'Suite ou pas...',
                'clue' => '<p>Par quoi doit être remplacé le point d\'interrogation ?</p>',
                'hint' => 'R',
                'answer' => '',
                'image' => '/images/eggs/cjwla.png',
                'information' => '',
            ],  
            [
                'code' => 'BKMFR',
                'title' => 'Encore et encore...',
                'clue' => '<p>Ce n\'est pas la force qui compte, mais la répétition.</p><p>Trouve le bon compte, et le silence cédera.</p>',
                'hint' => 'Tap tap tap...',
                'answer' => 'le fromage c\'est la vie',
                'image' => '',
                'information' => '',
            ],  
            [
                'code' => 'BGLSA',
                'title' => 'La bombonne d\'eau',
                'clue' => '<p>Une bonbonne d\'eau est presque vide, mais son volume double chaque jour.</p><p>Il faut 60 jours pour qu\'elle soit complètement remplie.</p><p>Combien de jours faut-il pour qu\'elle soit à moitié pleine ?</p>',
                'hint' => 'Indiquer que le nombre de jours sans le mot jour',
                'answer' => '59',
                'image' => '',
                'information' => '',
            ],  
            [
                'code' => 'MEGXA',
                'title' => 'Message subliminal',
                'clue' => '<p>Je suis bien là, sous tes yeux, mais tant que tu me regardes, je me cache.</p><p>Ne me lis pas, saisie-moi.</p><p style="color: transparent;">Printemps</p>',
                'hint' => '',
                'answer' => 'Printemps',
                'image' => '',
                'information' => '',
            ],  
            [
                'code' => 'MVXTR',
                'title' => 'Inverse et décalé',
                'clue' => '<p>On a codé un mot :</p><ul><li>Inversé</li><li>Décalé chaque lettre de +1</li></ul><div>Résultat : <strong>ojqbm</strong></div>',
                'hint' => '',
                'answer' => 'lapin',
                'image' => '',
                'information' => '',
            ],  
            [
                'code' => 'NEXIV',
                'title' => 'Lettres fragiles',
                'clue' => '<p>Quelles sont les lettres les plus fragiles ?</p>',
                'hint' => '',
                'answer' => 'oeufs',
                'image' => '',
                'information' => 'saisis sans l\'article et au pluriel',
            ],  
            [
                'code' => 'PLKQZ',
                'title' => 'Les gardiens de...',
                'clue' => '<p>Plus j\'ai de gardiens, moins je suis gardé. Qui suis-je ?</p>',
                'hint' => 'chuuuuut...',
                'answer' => 'secret',
                'image' => '',
                'information' => 'saisis sans l\'article',
            ],  
            [
                'code' => 'QZLPA',
                'title' => 'Observe !',
                'clue' => '<p>L\'œuf n\'offre jamais son trésor au premier regard.</p><p>Celui qui se contente de l\'apparence repart les mains vides.</p><p>Celui qui ose trahir la façade découvre ce qui était gardé.</p>',
                'hint' => '',
                'answer' => 'cloche',
                'image' => '',
                'information' => 'saisis sans l\'article',
            ],  
            [
                'code' => 'RDNOC',
                'title' => 'Le calcul impossible',
                'clue' => '<p>Pour résoudre cette énigme, touche l\'eggnigma.</p>',
                'hint' => '',
                'answer' => 'Cocotte',
                'image' => '',
                'information' => '',
            ],  
            [
                'code' => 'RYFNB',
                'title' => 'Triangles à la folie',
                'clue' => 'Combien de triangles vois-tu ?',
                'hint' => '',
                'answer' => '6',
                'image' => '/images/eggs/ryfnb.png',
                'information' => '',
            ],  
            [
                'code' => 'TPCWO',
                'title' => 'Menteur !',
                'clue' => '<p>Raphaël, Julien et Émile se disputent.</p><p>Raphaël dit que Julien ment.</p><p>Julien dit qu\'Émile ment.</p><p>Émile dit que Raphaël et Julien mentent".</p><p>Lesquels dit la vérité ?</p>',
                'hint' => 'Si Raphaël dit la vérité, alors l\'affirmation de Julien selon laquelle Émile ment serait un mensonge.',
                'answer' => 'Julien',
                'image' => '',
                'information' => '',
            ],
            [
                'code' => 'VSMQI',
                'title' => 'Les dents',
                'clue' => 'Qu\'est-ce qui a des dents, mais ne mange pas ?',
                'hint' => '',
                'answer' => 'peigne',
                'image' => '',
                'information' => 'saisis sans l\'article',
            ],  
            [
                'code' => 'XBKER',
                'title' => 'Le nombre mystère',
                'clue' => 'Quel numéro se chache derrière ce point d\'interrogation ?',
                'hint' => '',
                'answer' => '87',
                'image' => '/images/eggs/xbker.png',
                'information' => '',
            ],  
            [
                'code' => 'ZJRVW',
                'title' => 'Consonne, voyelles',
                'clue' => '<p>Quel mot a 6 lettres dont 5 voyelles ?</p>',
                'hint' => 'c\'est un animal',
                'answer' => 'oiseau',
                'image' => '',
                'information' => 'saisis sans l\'article',
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
