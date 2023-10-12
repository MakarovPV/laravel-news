<?php

namespace App\Modules\Parser\DataRetrieve;

use Symfony\Component\DomCrawler\Crawler;

class LongTextRetrieve extends DataRetrieve
{
    /**
     * Извлечение нескольких блоков текста со всей страницы по переданному в конструктор тегу
     * @param Crawler $crawler
     * @return string
     */
    public function retrieve(Crawler $crawler) : string
    {
        $full_description = '';
        $array = $crawler->filter($this->searchValue)->extract(['_text']);
        foreach($array as $text){
            $full_description .= ' ' . $text;
        };

        return $full_description;
    }
}
