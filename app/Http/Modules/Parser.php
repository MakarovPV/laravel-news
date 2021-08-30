<?php 

namespace App\Http\Modules;

use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Storage;
use App\Models\News;

class Parser 
{
	/**
     * @var Symfony\Component\DomCrawler\Crawler
     */
	private $crawler;

	/**
     * Получение содержимого страницы по указанному url.
     *
     * @param string $url
     *
     * @return object
     */
	public function parserInit($url)
	{
		$dom = file_get_contents($url);
		$this->crawler = new Crawler($dom, $url);
		return $this->crawler;
	}

	/**
     * Получение списка ссылок с основной страницы, соответствующих переданным параметрам, с последующим переходом по каждой из них.
     *
     * @param string $path
     *
     * @return string
     */
	public function search($path)
	{
		$links = $this->crawler->filter($path)->each(function(Crawler $node){
			return $this->requestPrepare($node->link()->getUri());
		});
	}

	/**
     * Получение содержимого страницы по переданному url, с последующим заполнением массива требуемыми данными.
     *
     * @param string $link
     *
     */
	public function requestPrepare($link)
	{
		$domChild = file_get_contents($link);	
		$crawlerChild = new Crawler($domChild, $link);

		$arr = [
			'title' => $crawlerChild->filter('div.post-title > h1')->text(),
			'short_description' => $crawlerChild->filter('div.post-lead > p')->text(),
			'full_description' => $crawlerChild->filter('div.body')->children('p')->each(function(Crawler $node){ 
				return $node->text(); 
			}),
			'news_picture' => $crawlerChild->filter('div.post-image-inner > a > img.wp-post-image')->attr('src'),
		];

		return $this->store($arr);
	}

	/**
     * Добавление полученных данных в таблицу.
     *
     * @param string $path
     *
     */
	public function store($array)
	{
		$full_description = '';

		foreach($array['full_description'] as $text){
			 $full_description .=  $text;
		}
		
		$news = News::insertOrIgnore([
            'title' => $array['title'],
            'short_description' => $array['short_description'],
            'full_description' => $full_description,
            'news_picture' => $array['news_picture'],
        ]);
	}
}