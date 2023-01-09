<?php

namespace App\Repositories;

use App\Models\ForumCategories;

class ForumCategoriesRepository extends CoreRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return ForumCategories::class;
    }

    /**
     * Получение списка категорий.
     * @return mixed
     */
    public function getCategories()
    {
    	return $this->model->all();
    }
}
