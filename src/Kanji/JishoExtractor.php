<?php

namespace App\Kanji;

class JishoExtractor
{
    /**
     * @param string $kanji
     * @return string
     */
    public static function getHtml(string $kanji, $tag = 'common'): string
    {
        return file_get_contents('https://jisho.org/search/' . urlencode('*' . $kanji . '* #') . $tag);
    }

    /**
     * @param $kanji
     * @return int|false
     */
    public static function getCommonCount(string $kanji): int|false
    {
        $jisho = self::getHtml($kanji);
        preg_match('/\<h4\>Words\<span class\="result_count"\> — (.*) found\<\/span\>\<\/h4\>/iU', $jisho, $matches);

        return $matches[1] ?? false;
    }

    /**
     * @param string $kanji
     * @return array
     */
    public static function getReadings(string $kanji): array
    {
        $jisho = self::getHtml($kanji, 'kanji');

        preg_match('#<dt>Kun:(.*)</dd>#isU', $jisho, $kunReadings);
        preg_match('#<dt>On:(.*)</dd>#isU', $jisho, $onReadings);

        return [
            'kun' => $kunReadings ? trim(strip_tags($kunReadings[1])) : null,
            'on' => $onReadings ? trim(strip_tags($onReadings[1])) : null,
        ];
    }
}
