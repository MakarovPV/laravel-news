<?php

namespace App\Http\Controllers\Admin\News;

use App\Repositories\NewsRepository;
use App\Models\News;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\NewsRequest;

class NewsController extends BaseController
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

        return view('laranews.admin.news.index', compact('paginate'));
    }

    /**
     * Страница создания новой новости.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('laranews.admin.news.create');
    }

    /**
     * Добавление новой новости.
     * @param NewsRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
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
     * Удаление новости.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $newsId = News::find($id)->delete();
        return back();
    }
}
