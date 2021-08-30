<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * The repository model.
     *
     * @var App\Repositories\UserRepository
     */
    private $user;

    /**
     * Create a new controller instance.
     *
     * @param App\Repositories\UserRepository $user
     * @param App\Models\UserInfo $userInfo
     *
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    /**
     * Displaying user profile.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
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
     * Remove the specified user from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function banUser($id)
    {
        $user = UserInfo::find($id);
        $user->is_banned = 1;
        $user->save();

        return back();
    }
}
