<?php

namespace Rohos\RsSitemap\Elements;

/**
 * Class Element
 * @package Rohos\RsSitemap\Elements
 */
class ElementBuilder
{
    /** @var $this|null */
    private static $instance;

    private function __construct() {}
    private function __clone() {}
    private function __sleep() {}
    private function __wakeup() {}

    /**
     * @return self
     */
    public static function i(): self
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * @param string $tag
     * @param mixed $val
     * @param string $newLine
     * @return string
     */
    public function build(string $tag, $val, $newLine = ''): string
    {
        return $this->buildBeginTag($tag) . $newLine
            . $this->prepare($val) . $newLine
            . $this->buildEndTag($tag) . $newLine;
    }

    /**
     * @param string $tag
     * @return string
     */
    public function buildBeginTag(string $tag): string
    {
        return '<'. $tag .'>';
    }

    /**
     * @param string $tag
     * @return string
     */
    public function buildEndTag(string $tag): string
    {
        return '</'. $tag .'>';
    }

    /**
     * @param string $str
     * @return string|string[]
     */
    protected function prepare(string $str)
    {
        return str_replace(
            ['&', '<', '>', '"', "'"],
            ["&amp;", "&lt;", "&gt;", "&quot;", "&apos;"],
            $str
        );
    }
}