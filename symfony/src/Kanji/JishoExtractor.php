<?php

namespace App\Kanji;

class JishoExtractor
{
    /**
     * @param $kanji
     * @return int|false
     */
    public static function getCommonCount($kanji): int|false
    {
        $jisho = file_get_contents('https://jisho.org/search/' . urlencode('*' . $kanji . '*') . '%20%23common');
        preg_match('/\<h4\>Words\<span class\="result_count"\> — (.*) found\<\/span\>\<\/h4\>/iU', $jisho, $matches);

        return $matches[1] ?? false;
    }
}
