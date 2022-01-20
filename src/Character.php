<?php

namespace AcidF0x\KoreanHandler;

class Character
{
    private ?string $choseong = null;
    private ?string $jungseong = null;
    private ?string $jongseong = null;
    /** @var array|string[] */
    private array $split = [];

    public function __construct(?string $choseong, ?string $jungseong, ?string $jongseong)
    {
        $this->choseong = $choseong;
        $this->jungseong = $jungseong;
        $this->jongseong = $jongseong;
    }

    public function getChoseong(): ?string
    {
        return $this->choseong;
    }

    public function setChoseong(?string $choseong): Character
    {
        $this->choseong = $choseong;
        return $this;
    }

    public function getJungseong(): ?string
    {
        return $this->jungseong;
    }

    public function setJungseong(?string $jungseong): Character
    {
        $this->jungseong = $jungseong;
        return $this;
    }

    public function getJongseong(): ?string
    {
        return $this->jongseong;
    }

    public function setJongseong(?string $jongseong): Character
    {
        $this->jongseong = $jongseong;
        return $this;
    }

    /**
     * @return array|string[]
     */
    public function getSplit(): array
    {
        return $this->split;
    }

    public function setSplit(): Character
    {
        $split = [
            $this->choseong,
            $this->jungseong
        ];

        if ($this->jongseong) {
            $split[] = $this->jongseong;
        }

        $this->split = $split;
        return $this;
    }
}
