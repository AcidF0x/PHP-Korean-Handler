<?php

namespace AcidF0x\KoreanHandler;

class Separator
{
    public function separate(string $string): SeparateResult
    {
        $array = array_filter(
            array_map(fn(string $string) => $this->doSeparator($string), mb_str_split($string)),
            fn($i) => $i !== null
        );

        return new SeparateResult($array);
    }

    private function doSeparator(string $char): ?Character
    {
        $code = mb_ord($char);
        if ($code < Constants::UNICODE_HANGUL_SYLLABLE_START || $code > Constants::UNICODE_HANGUL_SYLLABLE_END)
        {
            return null;
        }

        $base = $code - Constants::UNICODE_HANGUL_SYLLABLE_START;
        $choseongBase = ($base / 28) / 21;
        $jungseongBase = ($base / 28) % 21;
        $jongseongBase = $base % 28 - 1;

        $choseong = Constants::CHOSEONG_LIST[$choseongBase];
        $jungseong = Constants::JUNGSEONG_LIST[$jungseongBase];
        $jongseong = $jongseongBase > 0
            ? Constants::JONGSEONG_LIST[$jongseongBase]
            : null;

        $character = new Character($choseong, $jungseong, $jongseong);
        return $character->setSplit();
    }
}
