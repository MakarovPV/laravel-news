<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Repositories\NewsRepository;

class NewsController extends Controller
{
    /**
     * @var App\Repositories\NewsRepository|NewsRepository
     */
    private $newsPage;

    /**
     * @param NewsRepository $newsPage
     */
    public function __construct(NewsRepository $newsPage){
        $this->newsPage = $newsPage;
    }

    /**
     * Вывод страницы со списком новостей.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $paginate = $this->newsPage->getNewsWithPaginate(5);
        return view('laranews.news.index', compact('paginate'));
    }
}
