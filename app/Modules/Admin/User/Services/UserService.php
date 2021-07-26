<?php


namespace App\Modules\Admin\User\Services;


use App\Modules\Admin\User\Models\User;

class UserService
{
    public function getUsers()
    {
        $users = User::with('roles')->get();
        $users->transform(function($item) {
            $item->rolename = "";
            if (isset($item->roles)) {
                $item->rolename = isset($item->roles->first()->title) ? $item->roles->first()->title : "";
            }
            return $item;
        });

        return $users;
    }
}
