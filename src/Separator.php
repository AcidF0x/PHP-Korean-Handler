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
    const HANGUL_CHOSUNG_START = 4352;

    // UNICODE TABLE - 0x1161 = ㅏ
    const HANGUL_JOONG_START = 4449;

    // UNICODE TABLE - 0x11A8 = ᆨ
    const HANGUL_JONGSUNG_START = 4520;

    // SIMPLE CHOSUNG LIST
    const SIMPLE_CHOSUNG_LIST = ["ㄱ","ㄲ","ㄴ","ㄷ","ㄸ","ㄹ","ㅁ","ㅂ","ㅃ","ㅅ","ㅆ","ㅇ","ㅈ","ㅉ","ㅊ","ㅋ","ㅌ","ㅍ","ㅎ"];

    // SIMPLE JUNG SUNG LIST
    const SIMPLE_JUNGSUNG_LIST = ["ㅏ","ㅐ","ㅑ","ㅒ","ㅓ","ㅔ","ㅕ","ㅖ","ㅗ","ㅘ","ㅛ","ㅙ","ㅚ","ㅜ","ㅝ","ㅞ","ㅟ","ㅠ","ㅡ","ㅢ","ㅣ"];

    // SIMPLE JUNG SUNG LIST
    const SIMPLE_JONGSUNG_LIST = ["ㄱ","ㄲ","ㄳ","ㄴ","ㄵ","ㄶ","ㄷ","ㄹ","ㄺ","ㄻ","ㄼ","ㄽ","ㄾ","ㄿ","ㅀ","ㅁ","ㅂ","ㅄ","ㅅ","ㅆ","ㅇ","ㅈ","ㅊ","ㅋ","ㅌ","ㅍ","ㅎ"];

    /**
     * @var null|String $chosung
     */
    protected $chosung = null;

    /**
     * @var null|String $joongsung
     */
    protected $joongsung = null;

    /**
     * @var null|String $jongsung
     */
    protected $jongsung = null;

    /**
     * @var bool $strictMode
     */
    protected $strictMode = false;

    /**
     * @var array split
     */
    protected $split = [];
    /**
     * Get chosung
     * @return null|String
     */
    public function getChosung()
    {
        return $this->chosung;
    }

    /**
     * Get joongsung
     * @return null|String
     */
    public function getJoongsung()
    {
        return $this->joongsung;
    }

    /**
     * Get Jongsung
     * @return null|String
     */
    public function getJongsung()
    {
        return $this->jongsung;
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
        $chosungBase = ($base / 28) / 21;
        $joongsungBase = ($base / 28) % 21;
        $jongsungBase = $base % 28 - 1;

        $this->toChar($chosungBase, $joongsungBase, $jongsungBase);

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
     * @param float $chosungBase
     * @param float $joongsungBase
     * @param float $jongsungBase
     * @return boolean
     */
    protected function toChar($chosungBase, $joongsungBase, $jongsungBase)
    {
        if ($this->strictMode) {
            $this->chosung= mb_chr($chosungBase + self::HANGUL_CHOSUNG_START);
            $this->joongsung= mb_chr($joongsungBase + self::HANGUL_JOONG_START);
            $this->split = [ $this->chosung, $this->joongsung ];
            if ($jongsungBase > 0) {
                $this->jongsung = mb_chr($jongsungBase + self::HANGUL_JONGSUNG_START);
                $this->split[] = $this->jongsung;
            }
            return true;
        }

        $this->chosung = self::SIMPLE_CHOSUNG_LIST[intval($chosungBase)];
        $this->joongsung = self::SIMPLE_JUNGSUNG_LIST[intval($joongsungBase)];
        $this->split = [ $this->chosung, $this->joongsung ];
        if ($jongsungBase > 0) {
            $this->jongsung = self::SIMPLE_JONGSUNG_LIST[intval($jongsungBase)];
            $this->split[] = $this->jongsung;
        }
    }

    protected function clear()
    {
        $this->chosung = null;
        $this->joongsung = null;
        $this->jongsung = null;
        $this->split = [];
    }
}