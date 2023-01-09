<?php

namespace App\Modules\Parser;

class ImageRetrieve extends DataRetrieve
{
    /**
     * Извлечение картинок со страницы по переданному в конструктор тегу
     * @param $crawler
     * @return mixed
     */
    public function retrieve($crawler)
    {
        return $crawler->filter($this->searchValue)->attr('src');
    }
}
