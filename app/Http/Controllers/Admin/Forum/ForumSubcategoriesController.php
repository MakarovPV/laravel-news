<?php

namespace App\Http\Controllers\Admin\Forum;

use Illuminate\Support\Facades\Auth;
use App\Repositories\ForumSubcategoriesRepository;
use App\Http\Requests\ForumSubcategoryRequest;
use App\Models\ForumSubcategories;

class ForumSubcategoriesController extends BaseForumController
{
    /**
     * @var App\Repositories\ForumSubcategoriesRepository|ForumSubcategoriesRepository
     */
    private $subcategories;

    /**
     * @param ForumSubcategoriesRepository $subcategories
     */
    public function __construct(ForumSubcategoriesRepository $subcategories)
    {
        $this->subcategories = $subcategories;
    }

    /**
     * Вывод страницы со списком тем.
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create($id)
    {
       return view('laranews.admin.forum.subcategories.create', compact('id'));
    }

    /**
     * Добавление новой темы.
     * @param ForumSubcategoryRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $newsId = ForumSubcategories::find($id)->delete();

        return back();
    }
}
