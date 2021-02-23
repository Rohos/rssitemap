<?php

namespace Rohos\RsSitemap\Tests\Elements;

use PHPUnit\Framework\TestCase;
use Rohos\RsSitemap\Elements\Urlset;

/**
 * Class UrlsetTest
 * @package Rohos\RsSitemap\Tests\Elements
 */
class UrlsetTest extends TestCase
{
    const TAG = 'urlset';

    /** @var Urlset */
    private $urlset;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->urlset = new Urlset();
    }

    /** @test */
    public function isTagCorrect(): void
    {
        $this->assertEquals(self::TAG, $this->urlset->tag());
    }

    /** @test */
    public function isBeginTagCorrect(): void
    {
        $excepted = sprintf('<%s xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', self::TAG);

        $this->assertEquals($excepted, $this->urlset->beginTag());
    }

    /** @test */
    public function isEndTagCorrect(): void
    {
        $excepted = sprintf('</%s>', self::TAG);

        $this->assertEquals($excepted, $this->urlset->endTag());
    }
}
