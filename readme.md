# RsSitemap

A package for generating [SITEMAP](https://www.sitemaps.org/)

### 1. Installation
```bash
composer require rohos/rssitemap
```

### 2. Require:
```bash
"require": {
    "php": ">=7.1.0"
}
```

### 3. Example:
```php
use Rohos\RsSitemap\RsSitemap;
use Rohos\RsSitemap\Elements\Interfaces\ChangefreqElement;

$filepath = 'test.xml';
$sitemap = new RsSitemap($filepath);

$sitemap->openFile();

$url = $sitemap->newUrl('https://github.com/Rohos/rssitemap');

$sitemap->writeUrl(
    $url->setLastmod('2021-01-02')
        ->setChangefreq(ChangefreqElement::CHANGEFREQ_ALWAYS)
        ->setPriority(0.5)
);

$sitemap->closeFile();
```