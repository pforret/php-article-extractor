# pforret/pf-article-extractor

[![Tests](https://github.com/pforret/pf-article-extractor/actions/workflows/run-tests.yml/badge.svg)](https://github.com/pforret/pf-article-extractor/actions)
![GitHub Release](https://img.shields.io/github/v/release/pforret/pf-article-extractor)
![GitHub Tag](https://img.shields.io/github/v/tag/pforret/pf-article-extractor)
![GitHub commit activity](https://img.shields.io/github/commit-activity/y/pforret/pf-article-extractor)
[![Packagist Downloads](https://img.shields.io/packagist/dt/pforret/pf-article-extractor)](https://packagist.org/packages/pforret/pf-article-extractor)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?logo=php&logoColor=white)
![GitHub License](https://img.shields.io/github/license/pforret/pf-article-extractor)

![](assets/unsplash.squeeze.jpg)

Boilerplate Removal and Fulltext Extraction from HTML pages.

Rewrite of `dotpack/php-boiler-pipe` for PHP8.2 and up, with tests.

## Installation

```bash
composer require pforret/pf-article-extractor
```

## Usage

```php
use Pforret\PfArticleExtractor\ArticleExtractor;

$articleData = ArticleExtractor::getArticle($html);
/*
 * $articleData = Pforret\PfArticleExtractor\Formats\ArticleContents Object
(
    [title] => Film Podcast: Wicked Little Letters Named Film of the Month
    [content] => UK Film Club was back in March with a new episode of their film podcast. (...)
    [date] =>
    [images] => Array
        (
            [0] => https://static.wixstatic.com/media/.../b19cd0_dde0d59546f84127865267f43994f39b~mv2.jpg
        )

    [links] => Array
        (
            [0] => https://www.chrisolson.co.uk/
            (...)
        )

)

 */
```

## Under the hood

* package accepts a full HTML page as input
* it will walk the DOM tree and try to find the main article content
* it will remove boilerplate content (like headers, footers, sidebars, ...)
* it will try to extract the main article content
* it will try to extract the title, date, images and links from the article

Rights now it's tested with example pages for
* Blogger
* Drupal
* Jekyll
* Mkdocs
* Wix
* WordPress

## Similar packages

* [beautifulsoup4](https://pypi.org/project/beautifulsoup4/) - Python, MIT
* [html-text](https://pypi.org/project/html-text/) - Python, MIT
* [kohlschutter/boilerpipe](https://github.com/kohlschutter/boilerpipe) - Java, Apache 2.0
* [fivefilters/readability.php](https://github.com/fivefilters/readability.php) - PHP, GPL-3.0
* [miso-belica/jusText](https://github.com/miso-belica/jusText) - Python, BSD2
* [codelucas/newspaper](https://github.com/codelucas/newspaper) - Python, Apache
