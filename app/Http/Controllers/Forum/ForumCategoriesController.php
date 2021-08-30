<?php

namespace App\Http\Controllers\Forum;

use App\Repositories\ForumCategoriesRepository; 

class ForumCategoriesController extends BaseForumController
{
	/**
     * Объект репозитория.
     *
     * @var App\Repositories\ForumCategoriesRepository
     */
	private $categories;

	/**
     * Create a new controller instance.
     *
     * @param App\Repositories\ForumCategoriesRepository $categories
     *
     * @return void
     */
	public function __construct(ForumCategoriesRepository $categories)
	{
		$this->categories = $categories;
	}

	/**
     * Вывод страницы с категориями.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
    	$showCategories = $this->categories->getCategories();

    	return view('laranews.forum.categories.index', compact('showCategories'));
    }
}
