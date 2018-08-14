<?php

use PHPUnit\Framework\TestCase;
use AcidF0x\KoreanHandler\Separator;

class HangulTest extends TestCase
{

    public function testNonKoreaChar()
    {
        $separator = new Separator();
        $separator->separate('1');
        $this->assertNull($separator->getChosung());
        $separator->separate('100');
        $this->assertNull($separator->getChosung());
        $separator->separate('A');
        $this->assertNull($separator->getChosung());
        $separator->separate('æ');
        $this->assertNull($separator->getChosung());
        $separator->separate('語');
        $this->assertNull($separator->getChosung());
    }
    public function testSimpleMode() {
        $separator = new Separator();
        $separator->separate("가");
        $this->assertTrue($separator->getChosung() === "ㄱ");
        $this->assertTrue($separator->getJoongsung() === "ㅏ");
        $this->assertNull($separator->getJongsung());


        $separator->separate("곰");
        $this->assertTrue($separator->getChosung() === "ㄱ");
        $this->assertTrue($separator->getJoongsung() === "ㅗ");
        $this->assertTrue($separator->getJongsung() === "ㅁ");

        $separator->separate("쉐");
        $this->assertTrue($separator->getChosung() === "ㅅ");
        $this->assertTrue($separator->getJoongsung() === "ㅞ");
        $this->assertNull($separator->getJongsung());


        $separator->separate("벼");
        $this->assertTrue($separator->getChosung() === "ㅂ");
        $this->assertTrue($separator->getJoongsung() === "ㅕ");
        $this->assertNull($separator->getJongsung());


        $separator->separate("뷁");
        $this->assertTrue($separator->getChosung() === "ㅂ");
        $this->assertTrue($separator->getJoongsung() === "ㅞ");
        $this->assertTrue($separator->getJongsung() === "ㄺ");
    }

    public function testStrictMode() {
        $separator = new Separator();
        $separator->strictMode();
        $separator->separate("가");
        $this->assertTrue($separator->getChosung() === mb_chr(0x1100));
        $this->assertTrue($separator->getJoongsung() === mb_chr(0x1161));
        $this->assertNull($separator->getJongsung());


        $separator->separate("곰");
        $this->assertTrue($separator->getChosung() === mb_chr(0x1100));
        $this->assertTrue($separator->getJoongsung() === mb_chr(0x1169));
        $this->assertTrue($separator->getJongsung() === mb_chr(0x11B7));

        $separator->separate("쉐");
        $this->assertTrue($separator->getChosung() === mb_chr(0x1109));
        $this->assertTrue($separator->getJoongsung() === mb_chr(0x1170));
        $this->assertNull($separator->getJongsung());


        $separator->separate("뷁");
        $this->assertTrue($separator->getChosung() === mb_chr(0x1107));
        $this->assertTrue($separator->getJoongsung() === mb_chr(0x1170));
        $this->assertTrue($separator->getJongsung() === mb_chr(0x11b0));
    }

}