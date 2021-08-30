<?php

namespace App\Http\Controllers\Admin\Forum;

use Illuminate\Support\Facades\Auth;
use App\Repositories\ForumSubcategoriesRepository; 
use App\Repositories\ForumSubcategoriesCommentsRepository;
use App\Http\Requests\ForumSubcategoriesCommentsRequest;
use App\Models\ForumSubcategoriesComments;
use App\Models\ForumSubcategories;

class ForumSubcategoriesCommentsController extends BaseForumController
{
    /**
     * Объект репозитория.
     *
     * @var App\Repositories\ForumSubcategoriesRepository
     */
    private $subcategories;

    /**
     * Объект репозитория.
     *
     * @var App\Repositories\ForumSubcategoriesCommentsRepository
     */
    private $subcategoriesComments;

    /**
     * Create a new controller instance.
     *
     * @param App\Repositories\ForumSubcategoriesRepository $subcategories
     * @param App\Repositories\ForumSubcategoriesCommentsRepository $subcategoriesComments
     *
     * @return void
     */
    public function __construct(ForumSubcategoriesRepository $subcategories, ForumSubcategoriesCommentsRepository $subcategoriesComments)
    {
        $this->subcategories = $subcategories;
        $this->subcategoriesComments = new $subcategoriesComments;
    }

    /**
     * Вывод страницы обсуждения указанной темы.
     *
     * @param int $id
     * @param int $catId
     *
     * @return \Illuminate\View\View
     */
    public function index($id, $catId)
    {
        if(Auth::check()){
            $auth = Auth::id();
        } else {
            $auth = 0;
        }

        $showComments = $this->subcategoriesComments->getCommentsBySubcatId($id, $catId, 10, 1);
        $firstComment = $this->subcategories->getSubcategoriesFirstComment($id, $catId);

        $userSubcategoryCreator = ForumSubcategories::find($catId)->user;
        $userAnother = new ForumSubcategoriesComments();

        return view('laranews.forum.subcategories.comments.index', compact('id', 
                                                                           'catId',
                                                                           'auth', 
                                                                           'firstComment',
                                                                           'showComments',   
                                                                           'userSubcategoryCreator', 
                                                                           'userAnother'
                                                                           ));
    }

    /**
     * Добавление нового комментария.
     *
     * @param App\Http\Requests\ForumSubcategoriesCommentsRequest $request
     * @param int $id
     * @param int $catId
     *
     */
    public function store(ForumSubcategoriesCommentsRequest $request, $id, $catId)
    {
        $data = $request->input();

        $model = ForumSubcategoriesComments::insert([
            'user_id' => Auth::id(), 
            'subcategory_id' => $data['catId'], 
            'comment' => $data['comment']
        ]);
    }

    /**
     * Удаление указанного комментария.
     *
     * @param int $id
     * @param int $catId
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $catId)
    {
        $newsId = ForumSubcategoriesComments::find($catId)->delete();

        return back();
    }
}
