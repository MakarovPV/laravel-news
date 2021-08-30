<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\ForumCategories;

/**
 * Class ForumCategoriesRepository.
 */
class ForumCategoriesRepository extends CoreRepository
{
    /**
     * Возвращение класса модели.
     *
     * @return string
     */
    public function model()
    {
        return ForumCategories::class;
    }

	/**
     * Получение списка категорий.
     *
     * @return collection
     */
    public function getCategories()
    {
    	return $this->model->all();
    }
}
