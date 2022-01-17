<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Repositories\NewsRepository;

class NewsController extends Controller
{
    /**
     * Объект репозитория.
     *
     * @var App\Repositories\NewsRepository
     */
    private $newsPage;

    /**
     * Create a new controller instance.
     *
     * @param App\Repositories\NewsRepository $newsPage
     *
     * @return void
     */
    public function __construct(NewsRepository $newsPage){
        $this->newsPage = $newsPage;
    }

    /**
     * Вывод страницы со списком новостей.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $paginate = $this->newsPage->getNewsWithPaginate(5);

        return view('laranews.news.index', compact('paginate'));
    }
}
