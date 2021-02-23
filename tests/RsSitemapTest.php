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
        parent::setUp();

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
     * @param array $pages
     * @test
     * @dataProvider dataPages
     */
    public function isFileCreated(array $pages): void
    {
        $sitemap = new RsSitemap($this->getFilePath());
        $url = new Url();

        $sitemap->openFile();

        foreach ($pages as $page) {
            $sitemap->writeUrl(
                $url->setLoc($page['loc'])
                    ->setLastmod($page['lastmod'])
                    ->setChangefreq($page['changefreq'])
                    ->setPriority($page['priority'])
            );
        }

        $sitemap->closeFile();

        $this->assertFileExists($this->getFilePath());

        $xml = "\xEF\xBB\xBF" .'<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><url><loc>https://github.com/Rohos/rssitemap</loc><lastmod>2021-01-25</lastmod><changefreq>always</changefreq><priority>0.5</priority></url></urlset>'. "\n";

        $this->assertEquals($xml, file_get_contents($this->getFilePath()));
    }

    /**
     * @param array $pages
     * @test
     * @dataProvider dataPages
     */
    public function isCorrectCountAndClearUrl(array $pages)
    {
        $sitemap = new RsSitemap($this->getFilePath());
        $url = new Url();

        $sitemap->openFile();

        foreach ($pages as $page) {
            $sitemap->writeUrl(
                $url->setLoc($page['loc'])
                    ->setLastmod($page['lastmod'])
                    ->setChangefreq($page['changefreq'])
                    ->setPriority($page['priority'])
            );
        }

        $sitemap->closeFile();

        $this->assertEquals(1, $sitemap->countUrls());

        $sitemap->clearCountUrls();
        $this->assertEquals(0, $sitemap->countUrls());
    }

    /**
     * @return array
     */
    public function dataPages(): array
    {
        return [
            [
                [
                    [
                        'loc' => 'https://github.com/Rohos/rssitemap',
                        'lastmod' => '2021-01-25',
                        'changefreq' => 'always',
                        'priority' => 0.5,
                    ],
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
            unlink($this->getFilePath());
        }
    }
}
