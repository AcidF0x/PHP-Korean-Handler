<?php
/**
 * Created by PhpStorm.
 * User: duhui
 * Date: 2018. 8. 13.
 * Time: PM 9:39
 */

namespace AcidF0x\KoreanHandler;

class Separator
{
    // Gap between SYLLABLES table and JAMO table
    const HANGUL_START = 44032;

    // UNICODE TABLE - 0XAC00 = ㄱ
    const HANGUL_CHOSUNG_START = 4352;

    // UNICODE TABLE - 0x1161 = ㅏ
    const HANGUL_JUNGSUNG_START = 4449;

    // UNICODE TABLE - 0x0x11A8 = ᆨ
    const HANGUL_JONGSUNG_START = 4520;

    /**
     * @var null|String Chosung
     */
    protected $chosung = null;

    /**
     * @var null|String Chosung
     */
    protected $jungsung = null;

    /**
     * @var null|String Jongsung
     */
    protected $jongsung = null;

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
     * Get jungsung
     * @return null|String
     */
    public function getJungsung()
    {
        return $this->jungsung;
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
        $code = mb_ord($string);
        $base = $code - self::HANGUL_START;

        $this->chosung= mb_chr(($base / 28) / 21 + self::HANGUL_CHOSUNG_START);
        $this->jungsung= mb_chr(($base / 28) % 21 + self::HANGUL_JUNGSUNG_START);

        $this->split = [ $this->chosung, $this->jungsung ];
        if (($base % 28) > 0) {
            $this->jongsung = mb_chr(($base % 28) + self::HANGUL_JONGSUNG_START - 1);
            $this->split[] = $this->jongsung;
        }
        return $this;
    }

    protected function clear()
    {
        $this->chosung = null;
        $this->jungsung = null;
        $this->jongsung = null;
        $this->split = [];
    }
}