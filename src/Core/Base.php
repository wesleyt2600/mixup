<?php

namespace UPFlex\MixUp\Core;

abstract class Base
{
    protected static bool $instance = false;

    /**
     * @return bool
     */
    public static function isSelfInstance(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function getInstance(): bool
    {
        return true;
    }
}