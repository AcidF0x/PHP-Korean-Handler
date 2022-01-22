<?php


use AcidF0x\KoreanHandler\Separator;
use PHPUnit\Framework\TestCase;

class SeparatorTest extends TestCase
{
    private Separator $separator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->separator = new Separator();
    }

    /**
     * @dataProvider oneCharterProvider
     */
    public function testSeparate($char, $expectChoseong, $expectJungseong, $expectJongseong)
    {
        $result = $this->separator->separate($char);

        $this->assertSame($expectChoseong, $result[0]->getChoseong());
        $this->assertSame($expectJungseong, $result[0]->getJungseong());
        $this->assertSame($expectJongseong, $result[0]->getJongseong());
    }

    public function testGetLists()
    {
        $result = $this->separator->separate("안녕하세요");

        $this->assertSame(
            ["ㅇ","ㄴ","ㅎ","ㅅ","ㅇ"],
            $result->getChoseongList()
        );

        $this->assertSame(
            ["ㅏ","ㅕ","ㅏ","ㅔ","ㅛ"],
            $result->getJungseongList()
        );

        $this->assertSame(
            ["ㄴ", "ㅇ"],
            $result->getJongseongList()
        );

        $this->assertSame(
            ["ㅇ","ㅏ","ㄴ","ㄴ","ㅕ","ㅇ","ㅎ","ㅏ","ㅅ","ㅔ","ㅇ","ㅛ"],
            $result->getSplitList()
        );
    }

    public function oneCharterProvider(): array
    {
        return [
            ["가", "ㄱ", "ㅏ", null],
            ["냐", "ㄴ", "ㅑ", null],
            ["디", "ㄷ", "ㅣ", null],
            ["레", "ㄹ", "ㅔ", null],
            ["래", "ㄹ", "ㅐ", null],
            ["어", "ㅇ", "ㅓ", null],
            ["므", "ㅁ", "ㅡ", null],
            ["검", "ㄱ", "ㅓ", "ㅁ"],
            ["엄", "ㅇ", "ㅓ", "ㅁ"],
            ["쉥", "ㅅ", "ㅞ", "ㅇ"],
            ["웅", "ㅇ", "ㅜ", "ㅇ"],
            ["쾅", "ㅋ", "ㅘ", "ㅇ"],
            ["퀩", "ㅋ", "ㅞ", "ㅂ"],
            ["홦", "ㅎ", "ㅘ", "ㅄ"],
            ["풜", "ㅍ", "ㅝ", "ㄹ"],
            ["궭", "ㄱ", "ㅞ", "ㄺ"],
        ];
    }
}
