<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository extends CoreRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return News::class;
    }

    /**
     * Получение списка новостей.
     * @param int $perPage
     * @return mixed
     */
    public function getNewsWithPaginate($perPage = null){
    	$select = [
    			'id',
    			'title',
    			'short_description',
    			'news_picture',
    			'created_at',
    			];

    	$result = $this->model
    			->select($select)
                ->orderBy('created_at', 'DESC')
    			->paginate($perPage);

    	return $result;
    }
}
