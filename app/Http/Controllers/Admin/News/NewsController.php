<?php

namespace App\Http\Controllers\Admin\News;

use Illuminate\Http\Request;
use App\Repositories\NewsRepository;
use App\Models\News;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\NewsRequest;

class NewsController extends BaseController
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

        return view('laranews.admin.news.index', compact('paginate'));
    }

    /**
     * Страница создания новой новости.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('laranews.admin.news.create');
    }

    /**
     * Добавление новой новости.
     *
     * @param  App\Http\Requests\NewsRequest $request
     *
     */
    public function store(NewsRequest $request)
    {
        $data = $request->input();

        if(!empty($data['newsCreate'])){

            $filePath = "images/news_pictures";
            $file = $request->file('news_picture');
            $file->move($filePath, $file->getClientOriginalName());

            $news = News::insert([
                'title' => $data['title'],
                'short_description' => $data['short_description'],
                'full_description' => $data['full_description'],
                'news_picture' => '/' . $filePath . '/' . $file->getClientOriginalName(),
            ]);
         
        return redirect()->route('admin.news.index');    
        } 
    }

    /**
     * Удаление указанной новости.
     *
     * @param  int  $id
     *
     */
    public function destroy($id)
    {
        $newsId = News::find($id)->delete();
        return back();
    }
}
