<?php

namespace AcidF0x\KoreanHandler;

final class Constants
{
    /** @var int 한글 음절 첫글자 = 가 */
    public const UNICODE_HANGUL_SYLLABLE_START = 44032;
    /** @var int 한글 음절 마지막 글자 = 힣 */
    public const UNICODE_HANGUL_SYLLABLE_END = 55203;
    /** @var string[] 초성리스트 */
    public const CHOSEONG_LIST = ["ㄱ","ㄲ","ㄴ","ㄷ","ㄸ","ㄹ","ㅁ","ㅂ","ㅃ","ㅅ","ㅆ","ㅇ","ㅈ","ㅉ","ㅊ","ㅋ","ㅌ","ㅍ","ㅎ"];
    /** @var string[] 중성리스트 */
    const JUNGSEONG_LIST = ["ㅏ","ㅐ","ㅑ","ㅒ","ㅓ","ㅔ","ㅕ","ㅖ","ㅗ","ㅘ","ㅙ","ㅚ","ㅛ","ㅜ","ㅝ","ㅞ","ㅟ","ㅠ","ㅡ","ㅢ","ㅣ"];
    /** @var string[] 종성리스트 */
    const JONGSEONG_LIST = ["ㄱ","ㄲ","ㄳ","ㄴ","ㄵ","ㄶ","ㄷ","ㄹ","ㄺ","ㄻ","ㄼ","ㄽ","ㄾ","ㄿ","ㅀ","ㅁ","ㅂ","ㅄ","ㅅ","ㅆ","ㅇ","ㅈ","ㅊ","ㅋ","ㅌ","ㅍ","ㅎ"];
}
