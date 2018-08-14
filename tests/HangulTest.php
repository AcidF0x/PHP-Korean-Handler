<?php

use PHPUnit\Framework\TestCase;
use AcidF0x\KoreanHandler\Separator;

class HangulTest extends TestCase
{

    public function testNonKoreaChar()
    {
        $separator = new Separator();
        $separator->separate('1');
        $this->assertNull($separator->getChoseong());
        $separator->separate('100');
        $this->assertNull($separator->getChoseong());
        $separator->separate('A');
        $this->assertNull($separator->getChoseong());
        $separator->separate('æ');
        $this->assertNull($separator->getChoseong());
        $separator->separate('語');
        $this->assertNull($separator->getChoseong());
    }
    public function testSimpleMode() {
        $separator = new Separator();
        $separator->separate("가");
        $this->assertTrue($separator->getChoseong() === "ㄱ");
        $this->assertTrue($separator->getJungseong() === "ㅏ");
        $this->assertNull($separator->getJongseong());


        $separator->separate("곰");
        $this->assertTrue($separator->getChoseong() === "ㄱ");
        $this->assertTrue($separator->getJungseong() === "ㅗ");
        $this->assertTrue($separator->getJongseong() === "ㅁ");

        $separator->separate("쉐");
        $this->assertTrue($separator->getChoseong() === "ㅅ");
        $this->assertTrue($separator->getJungseong() === "ㅞ");
        $this->assertNull($separator->getJongseong());


        $separator->separate("벼");
        $this->assertTrue($separator->getChoseong() === "ㅂ");
        $this->assertTrue($separator->getJungseong() === "ㅕ");
        $this->assertNull($separator->getJongseong());


        $separator->separate("뷁");
        $this->assertTrue($separator->getChoseong() === "ㅂ");
        $this->assertTrue($separator->getJungseong() === "ㅞ");
        $this->assertTrue($separator->getJongseong() === "ㄺ");
    }

    public function testStrictMode() {
        $separator = new Separator();
        $separator->strictMode();
        $separator->separate("가");
        $this->assertTrue($separator->getChoseong() === mb_chr(0x1100));
        $this->assertTrue($separator->getJungseong() === mb_chr(0x1161));
        $this->assertNull($separator->getJongseong());


        $separator->separate("곰");
        $this->assertTrue($separator->getChoseong() === mb_chr(0x1100));
        $this->assertTrue($separator->getJungseong() === mb_chr(0x1169));
        $this->assertTrue($separator->getJongseong() === mb_chr(0x11B7));

        $separator->separate("쉐");
        $this->assertTrue($separator->getChoseong() === mb_chr(0x1109));
        $this->assertTrue($separator->getJungseong() === mb_chr(0x1170));
        $this->assertNull($separator->getJongseong());


        $separator->separate("뷁");
        $this->assertTrue($separator->getChoseong() === mb_chr(0x1107));
        $this->assertTrue($separator->getJungseong() === mb_chr(0x1170));
        $this->assertTrue($separator->getJongseong() === mb_chr(0x11b0));
    }

}