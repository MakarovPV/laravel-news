<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserInfo;

class UserObserver
{
    /**
     * Создание поля с данными пользователя при его регистрации.
     *
     * @param  \App\Models\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        return UserInfo::create([
            'user_id' => $user->id,
        ]);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }
}
