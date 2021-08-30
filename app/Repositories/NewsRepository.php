<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\News;

/**
 * Class NewsRepository.
 */
class NewsRepository extends CoreRepository
{
    /**
     * Возвращение класса модели.
     *
     * @return string
     */
    public function model()
    {
        return News::class;
    }

    /**
     * Получение списка новостей.
     *
     * @param int $id
     *
     * @return Collection
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
