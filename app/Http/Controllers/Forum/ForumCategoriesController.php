<?php

namespace App\Http\Controllers\Forum;

use App\Repositories\ForumCategoriesRepository;

class ForumCategoriesController extends BaseForumController
{
    /**
     * @var App\Repositories\ForumCategoriesRepository|ForumCategoriesRepository
     */
	private $categories;

    /**
     * @param ForumCategoriesRepository $categories
     */
	public function __construct(ForumCategoriesRepository $categories)
	{
		$this->categories = $categories;
	}

    /**
     * Вывод страницы с категориями.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
    	$showCategories = $this->categories->getCategories();

    	return view('laranews.forum.categories.index', compact('showCategories'));
    }
}
