<?php

namespace Rohos\RsSitemap\Elements;

use Rohos\RsSitemap\Elements\Interfaces\Element;

/**
 * Class Urlset
 * Инкапсулирует этот файл и указывает стандарт текущего протокола
 * @package Rohos\RsSitemap\Elements
 */
class Urlset implements Element
{
    /**
     * @inheritDoc
     */
    public function beginTag(): string
    {
        return ElementBuilder::i()
                ->buildBeginTag($this->tag() .' xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"');
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
    public function tag(): string
    {
        return 'urlset';
    }
}