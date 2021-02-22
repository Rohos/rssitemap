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

### 3. RsSitemap Class:
```php
use Rohos\RsSitemap\RsSitemap;

/**
* @param string $filepath - the path to the file
* @param bool $needNewLine - if true, add "new line" [default = false]
 */
$sitemap = new RsSitemap($filepath, $needNewLine);

/**
 * @param string $pageUrl - awaits page url
 * @return \Rohos\RsSitemap\Elements\Url
 */
$url = $sitemap->newUrl('https://github.com/Rohos/rssitemap');
```

### 4. Url Class:
```php
use Rohos\RsSitemap\Elements\Url;

/**
* @param string $pageUrl - page url - <loc>$pageUrl</loc>
* @param string $newLine - "new line" [default = '']
 */
$url = new Url($pageUrl, $newLine) {...}

/**
 * Last modified date of the file
 * @param string $val - Date (YYYY-MM-DD) or W3C Datetime
 * @return Url
 * @see https://www.w3.org/TR/NOTE-datetime
 */
$url->setLastmod($val);

/**
 * Likely frequency of changes to this page
 * @param string $val - one of constant \Rohos\RsSitemap\Elements\Interfaces\ChangefreqElement
 * @return Url
 * @throws \Rohos\RsSitemap\Exceptions\IncorrectElementValueException
 */
$url->setChangefreq($val);


/**
 * Priority of URLs relative to other URLs
 * @param string $val - The valid range of values is 0.0 to 1.0
 * @return Url
 * @throws \Rohos\RsSitemap\Exceptions\IncorrectElementValueException
 */
$url->setPriority($val);

```

### 5. Example:
```php
use Rohos\RsSitemap\RsSitemap;
use Rohos\RsSitemap\Elements\Interfaces\ChangefreqElement;

$filepath = 'test.xml';
$sitemap = new RsSitemap($filepath);

$sitemap->openFile();

$url = $sitemap->newUrl('https://github.com/Rohos/rssitemap');

$sitemap->writeUrl(
    $url->setLastmod('2021-01-24')
        ->setChangefreq(ChangefreqElement::ALWAYS)
        ->setPriority(0.5)
);

$sitemap->closeFile();
```
