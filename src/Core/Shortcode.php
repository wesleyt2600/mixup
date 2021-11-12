<?php

namespace UPFlex\MixUp\Core;

use UPFlex\MixUp\Core\Base;

abstract class Shortcode extends Base
{
    private array $callback = [];
    private string $tag;

    /**
     * @return array
     */
    public function getCallback(): array
    {
        return $this->callback;
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    public function run(): void
    {
        add_shortcode($this->getTag(), $this->getCallback());
    }

    /**
     * @param array $callback
     */
    public function setCallback(array $callback): void
    {
        $this->callback = $callback;
    }

    /**
     * @param string $tag
     */
    public function setTag(string $tag): void
    {
        $this->tag = $tag;
    }
}