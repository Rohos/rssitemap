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
 * Return new Url()
 * @param string $pageUrl - awaits page url
 * @return \Rohos\RsSitemap\Elements\Url
 */
$url = $sitemap->newUrl();


/**
 * Writes url data to a file and previously running the buildXml () method on it
 * @param Url $url
 * @return bool
 * @throws \Rohos\RsSitemap\Exceptions\NotSetRequiredValueException
 */
$sitemap->writeUrl($url);

/**
 * Open file
 * @throws \Rohos\RsSitemap\Exceptions\FileOpenException
 */
$sitemap->openFile();

/**
 * Close file
 */
$sitemap->closeFile();

/**
 * Returns the number of urls written
 * @return int
 */
$sitemap->countUrls();

/**
 * Clear number of urls written
 * @return int
 */
$sitemap->clearCountUrls();
```

### 4. Url Class:
```php
use Rohos\RsSitemap\Elements\Url;

/**
* @param string $newLine - "new line" [default = '']
 */
$url = new Url($newLine);

/**
 * Page URL - required
 * @param string $val - awaits page url
 * @return Url
 */
$url->setLoc($val);

/**
 * Last modified date of the file - not required
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

/**
 * Return xml for url element and clearing data, after that you can use this object for create new xml
 * @return string
 * @throws \Rohos\RsSitemap\ExceptionsNotSetRequiredValueException
 */
$url->buildXml();
```

### 5. Example:
```php
use Rohos\RsSitemap\RsSitemap;
use Rohos\RsSitemap\Elements\Interfaces\ChangefreqElement;

$filepath = 'test.xml';
$sitemap = new RsSitemap($filepath);
$pages = [
    [
        'loc' => 'https://github.com/Rohos/rssitemap',
        'lastmod' => '2021-01-25',
        'changefreq' => ChangefreqElement::ALWAYS,
        'priority' => 0.5,
    ], [
        'loc' => 'https://github.com/Rohos/rsyayml',
        'lastmod' => '2021-01-21T13:15:30Z',
        'changefreq' => ChangefreqElement::DAILY,
        'priority' => 0.7,
    ],
];

$sitemap->openFile();

$url = $sitemap->newUrl(); // $url = new Url();

foreach ($pages as $page) {
    $sitemap->writeUrl(
        $url->setLoc($page['loc'])
            ->setLastmod($page['lastmod'])
            ->setChangefreq($page['changefreq'])
            ->setPriority($page['priority'])
    );
}

$sitemap->closeFile();

echo $sitemap->countUrls() .' URLS recorded';
```
