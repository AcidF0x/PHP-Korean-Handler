# PHP-Korean-Handler
한글 자모 분리 라이브러리 (초성, 중성, 종성)

Installation
------------
install using composer:
```bash
 composer require acidf0x/php-korean-handler
```

Usage
------------
조회시 반환 값은 `U+3130`와 `U+318F` 사이의 *Hangul Compatibility Jamo*가 반환 됩니다. 
- See [Hangul Compatibility Jamo](https://unicode.org/charts/PDF/U3130.pdf)

```php
use AcidF0x\KoreanHandler\Seperator; 

$separator = new Seperator();

$result = $separator->separate("수상하게 돈이 많은");
print_r($result->getSplitList()); // ["ㅅ","ㅜ","ㅅ","ㅏ","ㅇ","ㅎ","ㅏ","ㄱ","ㅔ","ㄷ","ㅗ","ㄴ","ㅇ","ㅣ","ㅁ","ㅏ","ㄶ","ㅇ","ㅡ","ㄴ"]
print_r($result->getChoseongList()); // ["ㅅ", "ㅅ", "ㅎ", "ㄱ", "ㄷ", "ㅇ", "ㅁ", "ㅇ"]
print_r($result->getJungseongList()); // ["ㅜ", "ㅏ", "ㅏ", "ㅔ", "ㅗ", "ㅣ", "ㅏ", "ㅡ"]
print_r($result->getJongseongList()); // ["ㅇ","ㄴ","ㄶ","ㄴ"]
```
`separate` 메서드의 리턴 값은 `ArrayAccess`, `Iterator` 인터페이스를 구현하였으므로
각 결과에 대해 `Array`처럼 접근 하여 사용이 가능합니다

```php
$result = $this->separator->separate("황소");

$result[0]->getChoseong(); // ㅎ
$result[0]->getJungseong(); // ㅘ
$result[0]->getJongseong(); // ㅇ
$result[1]->getChoseong(); // ㅅ
$result[1]->getJungseong(); // ㅗ
$result[1]->getJongseong(); // null

$result[0]->getSplit(); // ["ㅎ", "ㅘ", "ㅇ"]


foreach ($result as $character) {
    $character->getChoseong();
}
```
