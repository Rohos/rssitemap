<?php

namespace Rohos\RsSitemap\Elements\Interfaces;

/**
 * Interface ElementGenerateXml
 * @package Rohos\RsSitemap\Elements\Interfaces
 */
interface ElementGenerateXml
{
    /**
     * @return string
     */
    public function buildXml(): string;
}