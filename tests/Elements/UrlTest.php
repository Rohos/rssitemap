<?php

namespace Rohos\RsSitemap\Tests\Elements;

use PHPUnit\Framework\TestCase;
use Rohos\RsSitemap\Elements\Url;

/**
 * Class UrlTest
 * @package Rohos\RsSitemap\Tests\Elements
 */
class UrlTest extends TestCase
{
    const TAG = 'url';

    /** @var Url */
    private $url;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        $this->url = new Url();
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
