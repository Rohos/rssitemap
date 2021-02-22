<?php

namespace Rohos\RsSitemap\Elements\Interfaces;

/**
 * Interface Element
 * @package Rohos\RsSitemap\Elements\Interfaces
 */
interface Element
{
    /**
     * @return string
     */
    public function tag(): string;

    /**
     * @return string
     */
    public function beginTag(): string;

    /**
     * @return string
     */
    public function endTag(): string;
}