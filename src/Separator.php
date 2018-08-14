<?php

namespace AcidF0x\KoreanHandler;

/**
 * 한글 초중성 분리 클래스
 * @package AcidF0x\KoreanHandler
 */
class Separator
{
    // Hangul Table Start Num 0xAC00
    const HANGUL_SYLLABLE_START = 44032;

    // Hangul Table End Num 0xD7AF
    const HANGUL_SYLLABLE_END = 55215;

    // UNICODE TABLE - 0x1100 = ㄱ
    const HANGUL_CHOSEONG_START = 4352;

    // UNICODE TABLE - 0x1161 = ㅏ
    const HANGUL_JOONGSEONG_START = 4449;

    // UNICODE TABLE - 0x11A8 = ᆨ
    const HANGUL_JONGSEONG_START = 4520;

    // SIMPLE CHOSEONG LIST
    const SIMPLE_CHOSEONG_LIST = ["ㄱ","ㄲ","ㄴ","ㄷ","ㄸ","ㄹ","ㅁ","ㅂ","ㅃ","ㅅ","ㅆ","ㅇ","ㅈ","ㅉ","ㅊ","ㅋ","ㅌ","ㅍ","ㅎ"];

    // SIMPLE JUNG SUNG LIST
    const SIMPLE_JOONGSEONG_LIST = ["ㅏ","ㅐ","ㅑ","ㅒ","ㅓ","ㅔ","ㅕ","ㅖ","ㅗ","ㅘ","ㅛ","ㅙ","ㅚ","ㅜ","ㅝ","ㅞ","ㅟ","ㅠ","ㅡ","ㅢ","ㅣ"];

    // SIMPLE JUNG SUNG LIST
    const SIMPLE_JONGSEONG_LIST = ["ㄱ","ㄲ","ㄳ","ㄴ","ㄵ","ㄶ","ㄷ","ㄹ","ㄺ","ㄻ","ㄼ","ㄽ","ㄾ","ㄿ","ㅀ","ㅁ","ㅂ","ㅄ","ㅅ","ㅆ","ㅇ","ㅈ","ㅊ","ㅋ","ㅌ","ㅍ","ㅎ"];

    /**
     * @var null|String $choseong
     */
    protected $choseong = null;

    /**
     * @var null|String $jungseong
     */
    protected $jungseong = null;

    /**
     * @var null|String $jongseong
     */
    protected $jongseong = null;

    /**
     * @var bool $strictMode
     */
    protected $strictMode = false;

    /**
     * @var array split
     */
    protected $split = [];
    /**
     * Get choseseong
     * @return null|String
     */
    public function getChoseong()
    {
        return $this->choseseong;
    }

    /**
     * Get jungseong
     * @return null|String
     */
    public function getJungseong()
    {
        return $this->jungseong;
    }

    /**
     * Get jongseong
     * @return null|String
     */
    public function getJongseong()
    {
        return $this->jongseong;
    }

    public function getSplit()
    {
        return $this->split;
    }
    /**
     * Separate Hangul
     *
     * @param string $string
     * @return $this
     */
    public function separate($string)
    {
        $this->clear();
        $code = mb_ord(mb_strlen($string) === 1 ? $string : substr($string, 0, 1));

        if ($code < self::HANGUL_SYLLABLE_START || $code > self::HANGUL_SYLLABLE_END) {
            return $this;
        }

        $base = $code - self::HANGUL_SYLLABLE_START;
        $choseongBase = ($base / 28) / 21;
        $jungseongBase = ($base / 28) % 21;
        $jongseongBase = $base % 28 - 1;

        $this->toChar($choseongBase, $jungseongBase, $jongseongBase);

        return $this;
    }

    /**
     * set strict Mode;
     * @return $this
     */
    public function strictMode()
    {
        $this->strictMode = true;
        return $this;
    }

    /**
     * set simple Mode;
     * @return $this
     */
    public function simpleMode()
    {
        $this->strictMode = false;
        return $this;
    }

    /**
     *
     * @param float $choseongBase
     * @param float $jungseongBase
     * @param float $jongseongBase
     * @return boolean
     */
    protected function toChar($choseongBase, $jungseongBase, $jongseongBase)
    {
        if ($this->strictMode) {
            $this->choseseong= mb_chr($choseongBase + self::HANGUL_CHOSEONG_START);
            $this->jungseong= mb_chr($jungseongBase + self::HANGUL_JOONGSEONG_START);
            $this->split = [ $this->choseseong, $this->jungseong ];
            if ($jongseongBase > 0) {
                $this->jongseong = mb_chr($jongseongBase + self::HANGUL_JONGSEONG_START);
                $this->split[] = $this->jongseong;
            }
            return true;
        }

        $this->choseseong = self::SIMPLE_CHOSEONG_LIST[intval($choseongBase)];
        $this->jungseong = self::SIMPLE_JOONGSEONG_LIST[intval($jungseongBase)];
        $this->split = [ $this->choseseong, $this->jungseong ];
        if ($jongseongBase > 0) {
            $this->jongseong = self::SIMPLE_JONGSEONG_LIST[intval($jongseongBase)];
            $this->split[] = $this->jongseong;
        }
    }

    protected function clear()
    {
        $this->choseseong = null;
        $this->jungseong = null;
        $this->jongseong = null;
        $this->split = [];
    }
}