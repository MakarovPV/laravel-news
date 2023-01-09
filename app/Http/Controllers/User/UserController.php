<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Объект репозитория.
     *
     * @var App\Repositories\UserRepository
     */
    private $user;

    /**
     * Create a new controller instance.
     *
     * @param App\Repositories\UserRepository $user
     *
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Вывод страницы пользователя.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function getProfile($id)
    {
        $sum = $this->user->countComments($id);

        $edit = false;
        if(Auth::id() == $id){
            $edit = true;
        }

        $profile = $this->user->profileInfo($id);
        return view('laranews.user.profile', compact('profile', 'sum', 'edit'));
    }  

    /**
     * Вывод страницы редактирования данных пользователя.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        if(Auth::id() == $id){
            $profile = $this->user->profileInfo($id);
            return view('laranews.user.edit', compact('profile'));
        } else {
            abort(404);
        }
    }

    /**
     * Изменение пароля.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     */
    public function updatePassword(Request $request, $id)
    {
        if(!empty($request['submitAvaLoad'])){
            return $this->updateAvatar($request, $id);
        }

        $data = $request->validate([
            'oldPassword' => 'required|min:8|max:16|string|password',
            'newPassword' => 'required|min:8|max:16|string',
        ]);

        $user = User::find($id);

        if(Hash::check($data['oldPassword'], $user->password)){
            $new = Hash::make($data['newPassword']);
            $user->password = $new;
            $user->save();
        }

        return back();
    }

    /**
     * Изменение аватара.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     */
    public function updateAvatar(Request $request, $id)
    {
        $data = $request->validate([
            'avaLoadName' => 'image',
        ]);

        $filePath = "images/users_avatars";

        $file = $request->file('avaLoadName');
        $file->move($filePath, $file->getClientOriginalName());

        $avatar = User::find($id);
        $avatar->avatar = '/' . $filePath . '/' . $file->getClientOriginalName();
        $avatar->save();
                  
        return back();
    }
}
