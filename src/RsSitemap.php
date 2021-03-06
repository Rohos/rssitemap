<?php

namespace Rohos\RsSitemap;

use Rohos\RsSitemap\Elements\Url;
use Rohos\RsSitemap\Elements\Urlset;
use Rohos\RsSitemap\Exceptions\FileOpenException;
use Rohos\RsSitemap\Exceptions\NotSetRequiredValueException;

/**
 * Class RsSitemap
 * @package Rohos\RsSitemap
 */
class RsSitemap
{
    /** @var string */
    private $filepath;

    /** @var resource|bool */
    private $handle = false;

    /** @var bool */
    private $needNewLine = false;

    /** @var Urlset */
    private $urlset;

    /** @var int */
    private $countUrls = 0;

    /**
     * RsSitemap constructor.
     * @param string $filepath
     * @param bool $needNewLine
     */
    public function __construct(string $filepath, bool $needNewLine = false)
    {
        $this->filepath = $filepath;
        $this->needNewLine = $needNewLine;
        $this->urlset = new Urlset();
    }

    /**
     * @throws FileOpenException
     */
    public function openFile()
    {
        $this->handle = fopen($this->filepath, 'a');

        if ($this->handle === false) {
            throw new FileOpenException('File open failed');
        }

        $this->countUrls = 0;

        $beginTxt = "\xEF\xBB\xBF" . '<?xml version="1.0" encoding="UTF-8"?>'
            . $this->nl()
            . $this->urlset->beginTag()
            . $this->nl();

        file_put_contents($this->filepath, $beginTxt);
    }

    /**
     * @param Url $url
     * @return bool
     * @throws NotSetRequiredValueException
     */
    public function writeUrl(Url $url): bool
    {
        if (fwrite($this->handle, $url->buildXml()) === false) {
            return false;
        }

        $this->countUrls++;
        return true;
    }

    /**
     * @return Url
     */
    public function newUrl(): Url
    {
        return new Url($this->nl());
    }

    /**
     * @return int
     */
    public function countUrls(): int
    {
        return $this->countUrls;
    }

    public function clearCountUrls()
    {
        return $this->countUrls = 0;
    }

    public function closeFile()
    {
        if ($this->handle) {
            fwrite($this->handle, $this->nl() . $this->urlset->endTag() . "\n");

            fclose($this->handle);
        }
    }

    /**
     * @return string
     */
    protected function nl(): string
    {
        return $this->needNewLine ? "\n" : '';
    }
}
