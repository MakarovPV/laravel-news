<?php

namespace App\Modules\Parser\DataRetrieve;

use Symfony\Component\DomCrawler\Crawler;

class ImageRetrieve extends DataRetrieve
{
    /**
     * Извлечение картинок со страницы по переданному в конструктор тегу.
     *
     * @param Crawler $crawler
     * @return string
     */
    public function retrieve(Crawler $crawler): string
    {
        return $crawler->filter($this->searchValue)->attr('src');
    }
}
