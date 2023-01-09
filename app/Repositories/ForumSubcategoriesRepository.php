<?php

namespace App\Repositories;

use App\Models\ForumSubcategories;

class ForumSubcategoriesRepository extends CoreRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return ForumSubcategories::class;
    }

    /**
     * Получение списка подкатегорий по id родительской категории.
     * @param int $id
     * @param int $perpage
     * @return mixed
     */
    public function getSubcategoriesById($id, $perpage = null)
    {
    	$result = $this->model
                ->select('forum_subcategories.id',
                         'forum_subcategories.subcategory_name',
                         'users.name')
    			->join('users', 'forum_subcategories.user_id', '=', 'users.id' )
    			->where('category_id', '=', $id)
    			->toBase()
    			->paginate($perpage);

    	return $result;
    }

    /**
     * Получение титульного поста подкатегории.
     * @param int $id
     * @param int $catId
     * @return mixed
     */
    public function getSubcategoriesFirstComment($id, $catId)
    {
        if($this->model->where('forum_subcategories.category_id', '=', $id)->where('forum_subcategories.id', '=', $catId)->first() == null)
        {
            abort(404);
        }

    	$result = $this->model
                ->select('forum_subcategories.id',
                         'forum_subcategories.subcategory_name',
                         'users.name', 'users.avatar',
                         'forum_subcategories.subcategory_first_comment')
    			->join('users', 'forum_subcategories.user_id', '=', 'users.id' )
    			->where('forum_subcategories.id', '=', $catId)
    			->toBase()
    			->get();

    	return $result;
    }
}
