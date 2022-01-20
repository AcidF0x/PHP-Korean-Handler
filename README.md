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
The return value is the *Hangul Compatibility Jamo* between `U+3130` and `U+318F`  
반환 값은 `U+3130`와 `U+318F` 사이의 *Hangul Compatibility Jamo*가 반환 됩니다. 
- See [Hangul Compatibility Jamo](https://unicode.org/charts/PDF/U3130.pdf)

```php
use AcidF0x\KoreanHandler\aaaaaaa; 

$separator = new aaaaaaa();

$separator->separate("가");
$separator->getChoseong(); //  "ㄱ" 
$separator->getJungseong(); //  "ㅏ"
$separator->getJongseong(); //  null
$separator->getSplit(); //  ["ㄱ","ㅏ"]

$separator->separate("셥");
$separator->getChoseong(); //  "ㅅ"
$separator->getJungseong(); //  "ㅕ"
$separator->getJongseong(); //  "ㅂ"
$separator->getSplit(); //  ["ㅅ", "ㅕ", "ㅂ"]
```
And Also, You can use the `strict mode` to get the correct *Hangul Jamo*  
The return value is the *Hangul Jamo* between `U+1100` and `U+11FF`  
엄격한 모드를 사용하여 `U+1100`와 `U+11FF` 사이의 정확한 한글 자모로 분리 할 수 있습니다.
- See [Hangul Jamo](https://unicode.org/charts/PDF/U1100.pdf)

```php
use AcidF0x\KoreanHandler\aaaaaaa; 

$separator = new aaaaaaa();
$separator->strictMode();

$separator->separate("가");
$separator->getChoseong(); // "ᄀ" (U+1100)
$separator->getJungseong(); //"ᅡ" (U+1161)
```
