<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @var App\Repositories\UserRepository|UserRepository
     */
    private $user;

    /**
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Вывод страницы профиля пользователя
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getProfile($id)
    {
        $sum = $this->user->countComments($id);
        $edit = false;
        if(Auth::id() == $id){
            $edit = true;
        }
        $profile = $this->user->profileInfo($id);

        return view('laranews.admin.user.profile', compact('profile', 'sum', 'edit'));
    }

    /**
     * Блокировка пользователя
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function banUser($id)
    {
        $user = UserInfo::find($id);
        $user->is_banned = 1;
        $user->save();

        return back();
    }
}
