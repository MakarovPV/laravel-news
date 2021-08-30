<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Repositories\NewsCommentsRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NewsCommentsRequest;
use App\Models\News;
use App\Models\UserInfo;
use App\Models\NewsComments;

class NewsCommentsController extends Controller
{
    /**
     * Объект репозитория.
     *
     * @var App\Repositories\NewsCommentsRepository
     */
    private $comments;

    /**
     * Create a new controller instance.
     *
     * @param App\Repositories\NewsCommentsRepository $comments
     * @param App\Models\UserInfo $userInfo
     *
     * @return void
     */
    public function __construct(NewsCommentsRepository $comments){
        $this->comments = $comments; 
    }

    /**
     * Вывод страницы комментариев к указанной новости.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        if(Auth::check()){
            $auth = Auth::id();
        } else {
            $auth = null;
        }

        $banCheck = UserInfo::find($auth);
        $showNewsById = News::findOrFail($id);
        $showComments = $this->comments->getCommentsByNewsId($id);

        return view('laranews.news.comments.index', compact('id', 
                                                            'auth',
                                                            'banCheck',
                                                            'showNewsById', 
                                                            'showComments'
                                                            ));
    }

    /**
     * Добавление нового комментария.
     *
     * @param  App\Http\Requests\NewsCommentsRequest  $request
     *
     */
    public function store(NewsCommentsRequest $request)
    {
        $data = $request->input();

        $model = NewsComments::insert([
            'parent_news_id' => $data['id'],
            'user_id' => Auth::id(),
            'comment' => $data['comment'],
        ]);
    }
}
