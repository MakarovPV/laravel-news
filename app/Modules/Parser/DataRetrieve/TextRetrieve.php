<?php

namespace App\Modules\Parser\DataRetrieve;

use Symfony\Component\DomCrawler\Crawler;

class TextRetrieve extends DataRetrieve
{
    /**
     * Извлечение одного блока текста со страницы по переданному в конструктор тегу.
     *
     * @param Crawler $crawler
     * @return string
     */
    public function retrieve(Crawler $crawler): string
    {
        $text = $crawler->filter($this->searchValue)->extract(['_text']);
        if($text){
            return $text[0];
        }
        return '';
    }
}
