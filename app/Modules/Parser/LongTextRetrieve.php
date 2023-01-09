<?php

namespace App\Modules\Parser;

class LongTextRetrieve extends DataRetrieve
{
    /**
     * Извлечение нескольких блоков текста со всей страницы по переданному в конструктор тегу
     * @param $crawler
     * @return mixed
     */
    public function retrieve($crawler)
    {
        $full_description = '';
        $array = $crawler->filter($this->searchValue)->extract(['_text']);
        foreach($array as $text){
            $full_description .= ' ' . $text;
        };

        return $full_description;
    }
}
