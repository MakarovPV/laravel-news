<?php

namespace App\Modules\Parser\DataRetrieve;

use Symfony\Component\DomCrawler\Crawler;

abstract class DataRetrieve
{
    /**
     * Искомый тег
     * @var string
     */
    protected string $searchValue;

    /**
     * @param string $searchValue
     */
    public function __construct(string $searchValue)
    {
        $this->searchValue = $searchValue;
    }

    /**
     * Извлечение данных со страницы по переданному в конструктор тегу
     * @param Crawler $crawler
     * @return string
     */
    abstract public function retrieve(Crawler $crawler) : string;
}
