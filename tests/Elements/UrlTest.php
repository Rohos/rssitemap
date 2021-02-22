<?php

namespace Rohos\RsSitemap\Tests\Elements;

use PHPUnit\Framework\TestCase;
use Rohos\RsSitemap\Elements\Url;
use Rohos\RsSitemap\Exceptions\IncorrectElementValueException;

/**
 * Class UrlTest
 * @package Rohos\RsSitemap\Tests\Elements
 */
class UrlTest extends TestCase
{
    const TAG = 'url';
    const URL = 'https://github.com/Rohos/rsyayml';

    /** @var Url */
    private $url;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        $this->url = new Url(self::URL);
    }

    /** @test */
    public function checkSimpleXml(): void
    {
        $xml = sprintf('<%s><loc>%s</loc></%s>', self::TAG, self::URL, self::TAG);
        $this->assertEquals($xml, $this->url->buildXml());
    }

    /** @test */
    public function checkSimpleXmlWithNl(): void
    {
        $nl = "\n";
        $url = new Url(self::URL, $nl);
        $format = '<%s>%s<loc>%s%s%s</loc>%s</%s>%s';
        $xml = sprintf($format, self::TAG, $nl, $nl, self::URL, $nl, $nl, self::TAG, $nl);

        $this->assertEquals($xml, $url->buildXml());
    }

    /** @test */
    public function checkValidLastmod(): void
    {
        $format = '<%s><loc>%s</loc><lastmod>%s</lastmod></%s>';
        $val = '2021-01-01';
        $this->url->setLastmod($val);
        $xml = sprintf($format, self::TAG, self::URL, $val, self::TAG);
        $this->assertEquals($xml, $this->url->buildXml());
    }

    /** @test */
    public function checkValidChangefreq(): void
    {
        $format = '<%s><loc>%s</loc><changefreq>%s</changefreq></%s>';
        $values = [
            'always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'
        ];

        foreach ($values as $val) {
            $this->url->setChangefreq($val);
            $xml = sprintf($format, self::TAG, self::URL, $val, self::TAG);
            $this->assertEquals($xml, $this->url->buildXml());
        }
    }

    /** @test */
    public function checkValidPriority(): void
    {
        $format = '<%s><loc>%s</loc><priority>%s</priority></%s>';
        $values = [0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1];

        foreach ($values as $val) {
            $this->url->setPriority($val);
            $xml = sprintf($format, self::TAG, self::URL, $val, self::TAG);
            $this->assertEquals($xml, $this->url->buildXml());
        }
    }

    /** @test */
    public function checkInValidPriority(): void
    {
        $format = '<%s><loc>%s</loc><priority>%s</priority></%s>';

        $values = [
            -1, 1.1, 'sdsd', '0.d', '', []
        ];

        foreach ($values as $val) {
            $this->expectException(IncorrectElementValueException::class);
            $this->url->setPriority($val);
            $xml = sprintf($format, self::TAG, self::URL, $val, self::TAG);
            $this->assertEquals($xml, $this->url->buildXml());
        }
    }

    /** @test */
    public function isTagCorrect(): void
    {
        $this->assertEquals(self::TAG, $this->url->tag());
    }

    /** @test */
    public function isBeginTagCorrect(): void
    {
        $excepted = sprintf('<%s>', self::TAG);

        $this->assertEquals($excepted, $this->url->beginTag());
    }

    /** @test */
    public function isEndTagCorrect(): void
    {
        $excepted = sprintf('</%s>', self::TAG);

        $this->assertEquals($excepted, $this->url->endTag());
    }
}
