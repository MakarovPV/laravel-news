<?php

namespace App\Repositories;

use App\Models\NewsComments;

class NewsCommentsRepository extends CoreRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return NewsComments::class;
    }

    /**
     * Получение списка комментариев для указанной новости.
     * @param int $id
     * @param int $isAdmin
     * @return mixed
     */
    public function getCommentsByNewsId($id, $isAdmin = 0)
    {
        if($isAdmin == 1){
            $result = $this->model->withTrashed()
                           ->select('news_comments.id',
                                    'news_comments.created_at',
                                    'news_comments.comment',
                                    'news_comments.deleted_at',
                                    'users.name',
                                    'user_info.is_banned')
                           ->where('parent_news_id', '=', $id)
                           ->join('users', 'news_comments.user_id', '=', 'users.id' )
                           ->join('user_info', 'news_comments.user_id', '=', 'user_info.user_id' )
                           ->orderBy('created_at')
                           ->toBase()
                           ->get();
        } else {
            $result = $this->model
                           ->select('news_comments.id',
                                    'news_comments.created_at',
                                    'news_comments.comment',
                                    'users.name',
                                    'user_info.is_banned')
                           ->where('parent_news_id', '=', $id)
                           ->join('users', 'news_comments.user_id', '=', 'users.id' )
                           ->join('user_info', 'news_comments.user_id', '=', 'user_info.user_id' )
                           ->orderBy('created_at')
                           ->toBase()
                           ->get();
        }

    	return $result;
    }
}
