<?php

namespace App\Modules\Parser;

use Symfony\Component\DomCrawler\Crawler;
use App\Models\News;


class Parser
{
	/**
     * @var Symfony\Component\DomCrawler\Crawler
     */
	private $crawler;

    /**
     * Данные, переданные юзером
     * @var array
     */
	private $data_from_user = [];

    /**
     * Данные, полученные с пропаршенных страниц
     * @var array
     */
	private $data_for_store = [];

    /**
     * Список ссылок, по которым будет осуществляться парсинг
     * @var array
     */
    private $links = [];

    /**
     * Добавление в массив данных от пользователя, где ключ - имя столбца в таблице, а значение - объект класса DataRetrieve
     * @param $array
     * @return void
     */
	public function setProperties($array)
	{
		$this->data_from_user = $array;
	}

    /**
     * Получение списка ссылок с основной страницы, соответствующих переданным параметрам
     * @param string $url
     * @param string $path
     * @return void
     */
	public function getLinksFromMainPage($url, $path)
	{
		$this->parserInitialization($url)->filter($path)->each(function(Crawler $node){
			$this->links[] = $node->link()->getUri();
		});
	}

    /**
     * Получение содержимого страницы по указанному url
     * @param string $url
     * @return Symfony\Component\DomCrawler\Crawler|Crawler
     */
	private function parserInitialization($url)
	{
		$dom = file_get_contents($url);
		$this->crawler = new Crawler($dom, $url);
		return $this->crawler;
	}

    /**
     * Добавление в массив data_for_store значений, полученных при переходе по ссылкам из массива links
     * @return void
     */
	public function retrieveDataFromPage()
	{
        foreach($this->links as $link){
            $this->parserInitialization($link);

            foreach($this->data_from_user as $key => $value){
                $this->data_for_store[$key][] = $value->retrieve($this->crawler);
            };
        }
        $this->links = [];
	}

    /**
     * Добавление полученных данных в таблицу
     * @return void
     */
	public function store()
	{
        for($i=0; $i<count($this->data_for_store['title']);$i++){
            News::insertOrIgnore([
                'title' => $this->data_for_store['title'][$i],
                'short_description' => $this->data_for_store['shortText'][$i],
                'full_description' => $this->data_for_store['longText'][$i],
                'news_picture' => $this->data_for_store['image'][$i],
            ]);
		}
	}
}