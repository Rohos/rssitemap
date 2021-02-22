<?php

namespace Rohos\RsSitemap\Tests;

use Rohos\RsSitemap\RsSitemap;
use PHPUnit\Framework\TestCase;
use Rohos\RsSitemap\Elements\Url;

/**
 * Class RsSitemapTest
 * @package Rohos\RsSitemap\Tests
 */
class RsSitemapTest extends TestCase
{
    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        $this->removeFile();
    }

    /**
     * @inheritDoc
     */
    protected function tearDown()
    {
        $this->removeFile();
    }

    /**
     * @param Url[] $urls
     * @test
     * @dataProvider dataUrls
     */
    public function isFileCreated(array $urls): void
    {
        $sitemap = new RsSitemap($this->getFilePath());

        $sitemap->openFile();

        foreach ($urls as $url) {
            $sitemap->writeUrl($url);
        }

        $sitemap->closeFile();

        $this->assertFileExists($this->getFilePath());

        $xml = "\xEF\xBB\xBF" .'<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><url><loc>https://github.com/Rohos/rssitemap</loc><lastmod>2021-01-25</lastmod><changefreq>always</changefreq><priority>0.5</priority></url></urlset>'. "\n";

        $this->assertEquals($xml, file_get_contents($this->getFilePath()));
    }

    /**
     * @return array
     */
    public function dataUrls(): array
    {
        return [
            [
                [
                    (new Url('https://github.com/Rohos/rssitemap'))
                        ->setLastmod('2021-01-25')
                        ->setChangefreq('always')
                        ->setPriority(0.5),
                ]
            ]
        ];
    }

    /**
     * @return string
     */
    protected function getFilePath(): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'data/test.xml';
    }

    protected function removeFile(): void
    {
        if (file_exists($this->getFilePath())) {
//            unlink($this->getFilePath());
        }
    }
}
