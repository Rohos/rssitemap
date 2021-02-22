<?php

namespace Rohos\RsSitemap\Elements;

use Rohos\RsSitemap\Elements\Interfaces\Element;
use Rohos\RsSitemap\Elements\Interfaces\ElementGenerateXml;

/**
 * Class Url
 * @package Rohos\RsSitemap\Elements
 */
class Url implements Element, ElementGenerateXml
{
    /** @var array */
    protected $data = [];

    /**
     * @inheritDoc
     */
    public function tag(): string
    {
        return 'url';
    }

    /**
     * @inheritDoc
     */
    public function beginTag(): string
    {
        return ElementBuilder::i()->buildBeginTag($this->tag());
    }

    /**
     * @inheritDoc
     */
    public function endTag(): string
    {
        return ElementBuilder::i()->buildEndTag($this->tag());
    }

    /**
     * @inheritDoc
     */
    public function getXml(): string
    {
        // TODO: Implement getXml() method.
    }
}