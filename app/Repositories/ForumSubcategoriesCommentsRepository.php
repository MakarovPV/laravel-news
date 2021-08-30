<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\ForumSubcategoriesComments;

/**
 * Class ForumSubcategoriesCommentsRepository.
 */
class ForumSubcategoriesCommentsRepository extends CoreRepository
{
    /**
     * Возвращение класса модели.
     *
     * @return string
     */
    public function model()
    {
        return ForumSubcategoriesComments::class;
    }

     /**
     * Получение комментариев для указанного подраздела.
     *
     * @return Collection
     */
    public function getCommentsBySubcatId($id, $catId, $perpage = null, $isAdmin = 0)
    {
        $arrSelect = [];
        if($isAdmin == 1){
            $arrSelect = ['forum_subcategories_comments.id', 
                         'forum_subcategories_comments.comment',
                         'forum_subcategories_comments.deleted_at'
                         ];
        } else {
            $arrSelect = ['forum_subcategories_comments.id', 
                         'forum_subcategories_comments.comment',
                         ];
        }

        $result = $this->model
            ->withTrashed()
            ->select($arrSelect)
            ->join('forum_subcategories', 'forum_subcategories_comments.subcategory_id', '=', 'forum_subcategories.id' )
            ->where('subcategory_id', '=', $catId)
            ->where('forum_subcategories.category_id', '=', $id)
            ->toBase()
            ->paginate($perpage);
    	
    	return $result;
    }
}
