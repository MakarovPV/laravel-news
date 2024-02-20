<?php

namespace App\Modules\Parser;

use App\Models\News;
use App\Modules\Parser\SelectorPresets\SelectorPresetForDataRetrieve;
use Illuminate\Support\Facades\DB;
use Symfony\Component\DomCrawler\Crawler;

class Parser
{
    /**
     * Объект класса сайта, по которому будет осуществляться поиск.
     *
     * @var SelectorPresetForDataRetrieve
     */
    private SelectorPresetForDataRetrieve $siteObject;

	/**
     * @var Symfony\Component\DomCrawler\Crawler
     */
	private Crawler $crawler;

    /**
     * Данные, переданные пользователем.
     *
     * @var array
     */
	private array $data_from_user = [];

    /**
     * Данные, полученные с пропаршенных страниц.
     *
     * @var array
     */
	private array $data_for_store = [];

    /**
     * Список ссылок, по которым будет осуществляться парсинг.
     *
     * @var array
     */
    private array $links = [];

    /**
     * @param SelectorPresetForDataRetrieve $siteObject
     * @return $this
     */
    public function setUrl(SelectorPresetForDataRetrieve $siteObject)
    {
        $this->siteObject = $siteObject;
        return $this;
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $this->getLinksFromMainPage();
        $this->setProperties();
        $this->retrieveDataFromPage();
        $this->store();
    }

    /**
     * Добавление в массив данных от пользователя, где ключ - имя столбца в таблице, а значение - объект класса DataRetrieve.
     *
     * @param $array
     * @return void
     */
	private function setProperties(): void
	{
		$this->data_from_user = $this->siteObject->getReceivedData();
	}

    /**
     * Получение списка ссылок с основной страницы, соответствующих переданным параметрам.
     *
     * @param SelectorPresetForDataRetrieve $siteObject
     * @return void
     */
    private function getLinksFromMainPage(): void
	{
		$this->parserInitialization($this->siteObject->getSiteUrl())->filter($this->siteObject->getUrlSelector())->each(function(Crawler $node){
			$this->links[] = $node->link()->getUri();
		});
	}

    /**
     * Получение содержимого страницы по указанному url.
     *
     * @param string $url
     * @return Symfony\Component\DomCrawler\Crawler|Crawler
     */
	private function parserInitialization(string $url)
	{
		$dom = file_get_contents($url);
		$this->crawler = new Crawler($dom, $url);
		return $this->crawler;
	}

    /**
     * Добавление в массив data_for_store значений, полученных при переходе по ссылкам из массива links.
     *
     * @return void
     */
    private function retrieveDataFromPage(): void
	{
        foreach($this->links as $link){
            $this->parserInitialization($link);

            foreach($this->data_from_user as $key => $value){
                $this->data_for_store[$key][] = $this->data_from_user[$key]->retrieve($this->crawler);
            };
        }
	}

    /**
     * Добавление полученных данных в таблицу.
     *
     * @return void
     */
    private function store(): void
	{
        for($i=0; $i<count($this->data_for_store['title']);$i++){
            DB::beginTransaction();
            try{
                News::InsertOrIgnore([
                    'title' => $this->data_for_store['title'][$i],
                    'short_description' => $this->data_for_store['shortText'][$i],
                    'full_description' => $this->data_for_store['longText'][$i],
                    'news_picture' => $this->data_for_store['image'][$i],
                ]);
                $newsId = News::where('title', $this->data_for_store['title'][$i])->first();
                $newsId->newsUrls()->insertOrIgnore([
                    'news_id' => $newsId->id,
                    'url' => $this->links[$i],
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
            }
            DB::commit();
        }
        $this->clear();
	}

    /**
     * @return void
     */
    private function clear(): void
    {
        $this->links = [];
        $this->data_from_user = [];
        $this->data_for_store = [];
    }
}
