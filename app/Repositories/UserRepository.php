<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository.
 */
class UserRepository extends CoreRepository
{
    /**
     * Возвращение класса модели.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Вывод информации о пользователе.
     *
     * @param int $id
     *
     * @return model
     */
    public function profileInfo($id)
    {
        $result = $this->model->findOrFail($id);
        return $result;
    }

    /**
     * Подсчёт общего количества комментариев пользователя.
     *
     * @param int $id
     *
     * @return int
     */
    public function countComments($id)
    {

        $news_comments = DB::table('news_comments')
                        ->select('comment')
                        ->where('user_id', $id)
                        ->whereNull('deleted_at')
                        ->count();

        $forum_subcategories = DB::table('forum_subcategories')
                        ->select('subcategory_first_comment')
                        ->where('user_id', $id)
                        ->whereNull('deleted_at')
                        ->count();

        $forum_subcategories_comments = DB::table('forum_subcategories_comments')
                        ->select('comment')
                        ->where('user_id', $id)
                        ->whereNull('deleted_at')
                        ->count();

        return $news_comments + $forum_subcategories + $forum_subcategories_comments;
    }
}
