<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Admin\BaseController;
use App\Repositories\NewsCommentsRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NewsCommentsRequest;
use App\Models\News;
use App\Models\UserInfo;
use App\Models\NewsComments;

class NewsCommentsController extends BaseController
{
    /**
     * @var App\Repositories\NewsCommentsRepository|NewsCommentsRepository
     */
    private $comments;

    /**
     * @param NewsCommentsRepository $comments
     */
    public function __construct(NewsCommentsRepository $comments){
        $this->comments = $comments;
    }

    /**
     * Вывод страницы комментариев к указанной новости.
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($id)
    {
        if(Auth::check()){
            $auth = Auth::id();
        } else {
            $auth = 0;
        }

        $banCheck = UserInfo::find($auth);
        $showNewsById = News::findOrFail($id);
        $showComments = $this->comments->getCommentsByNewsId($id, 1);

        return view('laranews.admin.news.comments.index', compact('id',
                                                                  'auth',
                                                                  'banCheck',
                                                                  'showNewsById',
                                                                  'showComments',
                                                                  ));
    }

    /**
     * Добавление нового комментария.
     * @param NewsCommentsRequest $request
     * @return void
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

    /**
     * Удаление указанного комментария.
     * @param int $newsId
     * @param int $commentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($newsId, $commentId)
    {
        $newsId = NewsComments::find($commentId)->delete();

        return back();
    }
}
