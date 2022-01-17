<?php

namespace App\Http\Modules;

use Symfony\Component\DomCrawler\Crawler;
use App\Models\News;

class Parser
{
	/**
     * @var Symfony\Component\DomCrawler\Crawler
     */
	private $crawler;

	/**
     * @var Symfony\Component\DomCrawler\Crawler
     */
	private $data_from_user = [];

	/**
     * @var Symfony\Component\DomCrawler\Crawler
     */
	private $data_for_store = [];

	public function setProperties($array)
	{
		$this->data_from_user = $array;
	}

	/**
     * Получение списка ссылок с основной страницы, соответствующих переданным параметрам, с последующим переходом по каждой из них.
     *
     * @param string $path
     *
     * @return string
     */
	public function getLinksFromMainPage($url, $path)
	{
		$links = $this->parserInitialization($url)->filter($path)->each(function(Crawler $node){
			return $this->retrieveDataByUrl($node->link()->getUri());
		});
	}

	/**
     * Получение содержимого страницы по указанному url.
     *
     * @param string $url
     *
     * @return object
     */
	private function parserInitialization($url)
	{
		$dom = file_get_contents($url);
		$this->crawler = new Crawler($dom, $url);
		return $this->crawler;
	}

	/**
     * Получение содержимого страницы по переданному url, с последующим заполнением массива требуемыми данными.
     *
     * @param string $link
     *
     */
	private function retrieveDataByUrl($url)
	{
		$this->parserInitialization($url);

		foreach($this->data_from_user as $key => $value){
			$function = $key . 'Retrieve';
			$this->data_for_store[$key][] = $this->$function($value);
		};
	}

	private function titleRetrieve($value)
	{
		return $this->crawler->filter($value)->text();
	}

	private function shortTextRetrieve($value)
	{
		return $this->crawler->filter($value)->text();
	}

	private function longTextRetrieve($value)
	{
		$full_description = '';
		$array = $this->crawler->filter($value)->children('p')->each(function(Crawler $node){
			return $node->text();
		});

		foreach($array as $text){
			$full_description .= $text;
		};

		return $full_description;
	}

	private function imageRetrieve($value)
	{
		return $this->crawler->filter($value)->attr('src');
	}

	/**
     * Добавление полученных данных в таблицу.
     *
     * @param string $path
     *
     */
	public function store()
	{
		for($i=0; $i<count($this->data_for_store['title']);$i++){
			$news = News::insertOrIgnore([
		        'title' => $this->data_for_store['title'][$i],
		        'short_description' => $this->data_for_store['shortText'][$i],
		        'full_description' => $this->data_for_store['longText'][$i],
		        'news_picture' => $this->data_for_store['image'][$i],
        	]);
		};	
	}
}
