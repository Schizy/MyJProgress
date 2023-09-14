<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KatakanaController extends AbstractController
{
    #[Route('/katakana', name: 'katakana')]
    public function katakana(): Response
    {
        $katakana = [
           'ア' => 'a',
           'イ' => 'i',
           'ウ' => 'u',
           'エ' => 'e',
           'オ' => 'o',
           'カ'=> 'ka',
           'キ' => 'ki',
           'ク' => 'ku',
           'ケ' => 'ke',
           'コ' => 'ko',
           'キャ' => 'kya',
           'キュ' => 'kyu',
           'キョ' => 'kyo',
           'サ' => 'sa',
           'シ' => 'shi',
           'ス' => 'su',
           'セ' => 'se',
           'ソ' => 'so',
           'シャ' => 'sha',
           'シュ' => 'shu',
            'ショ' => 'sho',
            'タ' => 'ta',
            'チ' => 'chi',
            'ツ' => 'tsu',
            'テ' => 'te',
            'ト' => 'to',
            'チャ' => 'cha',
            'チュ' => 'chu',
            'チョ' => 'cho',
            'ナ' => 'na',
            'ニ' => 'ni',
            'ヌ' => 'nu',
            'ネ' => 'ne',
            'ノ' => 'no',
            'ニャ' => 'nya',
            'ニュ' => 'nyu',
            'ニョ' => 'nyo',
            'ハ' => 'ha',
            'ヒ' => 'hi',
            'フ' => 'fu',
            'ヘ' => 'he',
            'ホ' => 'ho',
            'ヒャ' => 'hya',
            'ヒュ' => 'hyu',
            'ヒョ' => 'hyo',
            'マ' => 'ma',
            'ミ' =>  'mi',
            'ム' =>  'mu',
            'メ' => 'me',
            'モ' => 'mo',
            'ミャ' => 'mya',
            'ミュ' => 'myu',
            'ミョ' => 'myo',
            'ヤ' =>  'ya',
            'ユ' => 'yu',
            'ヨ' => 'yo',
            'ラ' => 'ra',
            'リ' => 'ri',
            'ル' => 'ru',
            'レ' => 're',
            'ロ' => 'ro',
            'リャ' => 'rya',
            'リュ' => 'ryu',
            'リョ' => 'ryo',
            'ワ' => 'wa',
            'ン' => 'n',
            'ガ' => 'ga',
            'ギ' => 'gi',
            'グ' => 'gu',
            'ゲ' => 'ge',
            'ゴ' => 'go',
            'ギャ' => 'gya',
            'ギュ' => 'gyu',
            'ギョ' => 'gyo',
            'ザ' => 'za',
            'ジ' =>  'ji',
            'ズ' => 'zu',
            'ゼ' => 'ze',
            'ゾ' => 'zo',
            'ジャ' => 'ja',
            'ジュ' => 'ju',
            'ジョ' => 'jo',
            'ダ' => 'da',
            'ヂ' => 'ji',
            'ヅ' => 'zu',
            'デ' => 'de',
            'ド' => 'do',
            'バ' => 'ba',
            'ビ' => 'bi',
            'ブ' => 'bu',
            'ベ' => 'be',
            'ボ' => 'bo',
            'ビャ' => 'bya',
            'ビュ' => 'byu',
            'ビョ' => 'byo',
            'パ' =>  'pa',
            'ピ' => 'pi',
            'プ' => 'pu',
            'ペ' => 'pe',
            'ポ' => 'po',
            'ピャ' => 'pya',
            'ピュ' => 'pyu',
            'ピョ' => 'pyo',
            'ファ' => 'fa',
            'フィ' => 'fi',
            'フェ' => 'fe',
            'フォ' => 'fo',
            'ツァ' => 'tsa',
            'ティ' => 'ti',
            'トゥ' => 'tu',
            'ウェ' => 'we',
            'ウォ' => 'wo',
            'ー'   => '-',
        ];

        $lenght = random_int(8, 13);
        $randomKanas = array_rand($katakana, $lenght);

        for($i=1;$i<=random_int(1,5);$i++) {
            array_splice($randomKanas, random_int(1, count($randomKanas) - 1), 0, 'ー');
        }

        $generatedKatakanas = implode('', $randomKanas);
        $generatedKatakanas = str_replace("ーー", "ー", $generatedKatakanas);
        $generatedResponse = '';

        foreach($randomKanas as $key) {
            $generatedResponse .= $katakana[$key] . ' ';
        }

        return $this->render('katakana/index.html.twig', [
            'title' => 'Exercice de lecture de Katakana',
            'generatedKatakanas' => $generatedKatakanas,
            'generatedResponse' => $generatedResponse,
        ]);
    }
}
