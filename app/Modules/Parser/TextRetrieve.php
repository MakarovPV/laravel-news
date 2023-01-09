<?php

namespace App\Modules\Parser;

class TextRetrieve extends DataRetrieve
{
    /**
     * Извлечение одного блока текста со страницы по переданному в конструктор тегу
     * @param $crawler
     * @return mixed
     */
    public function retrieve($crawler)
    {
        $text = $crawler->filter($this->searchValue)->extract(['_text']);
        if($text){
            return $text[0];
        }
    }
}
