<?php

namespace App\Http\Controllers\Admin\Forum;

use Illuminate\Support\Facades\Auth;
use App\Repositories\ForumSubcategoriesRepository; 
use App\Http\Requests\ForumSubcategoryRequest;
use App\Models\ForumSubcategories;

class ForumSubcategoriesController extends BaseForumController
{
    /**
     * Объект репозитория.
     *
     * @var App\Repositories\ForumSubcategoriesRepository
     */
    private $subcategories;

    /**
     * Create a new controller instance.
     *
     * @param App\Repositories\ForumSubcategoriesRepository $subcategories
     *
     * @return void
     */
    public function __construct(ForumSubcategoriesRepository $subcategories)
    {
        $this->subcategories = $subcategories;
    }

    /**
     * Вывод страницы со списком тем.
     *
     * @param int $id 
     *
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $showSubcat = $this->subcategories->getSubcategoriesById($id);
        $qwe = ForumSubcategories::find($id)->user();
        echo $qwe['name'];
        return view('laranews.admin.forum.subcategories.index', compact('showSubcat', 'id'));
    }

    /**
     * Страница создания новой темы.
     *
     * @param int $id 
     *
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
       return view('laranews.admin.forum.subcategories.create', compact('id'));
    }

    /**
     * Добавление новой темы.
     *
     * @param App\Http\Requests\ForumSubcategoryRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ForumSubcategoryRequest $request, $id)
    {
        $auth = Auth::id();
        $data = $request->input();

        $model = ForumSubcategories::insert([
            'user_id' => $auth, 
            'category_id' => $id,
            'subcategory_name' => $data['subcategory_name'], 
            'subcategory_first_comment' => $data['comment'],
        ]);

        return $this->index($id);  
    }

    /**
     * Удаление указанной темы.
     *
     * @param  int  $id
     *
     */
    public function destroy($id)
    {
        $newsId = ForumSubcategories::find($id)->delete();

        return back();
    }
}
