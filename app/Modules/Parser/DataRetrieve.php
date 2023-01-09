<?php

namespace App\Modules\Parser;

abstract class DataRetrieve
{
    /**
     * Искомый тег
     * @var
     */
    protected $searchValue;

    /**
     * @param $searchValue
     */
    public function __construct($searchValue)
    {
        $this->searchValue = $searchValue;
    }

    /**
     * Извлечение данных со страницы по переданному в конструктор тегу
     * @param $crawler
     * @return mixed
     */
    abstract public function retrieve($crawler);
}
