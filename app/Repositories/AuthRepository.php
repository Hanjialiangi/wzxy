<?php

namespace App\Repositories;

use Czim\Repository\BaseRepository;
use App\Models\Auth;

class AuthRepository extends BaseRepository
{

    public function model()
    {
        return Auth::class;
    }

    /**
     * 登陆
     */
    public function login($request)
    {
        $username = $request->username;
        $password = $request->password;
        return 'success';
    }
}