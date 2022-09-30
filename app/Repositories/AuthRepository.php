<?php

namespace App\Repositories;

use Czim\Repository\BaseRepository;
use App\Models\Customer as User;
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
        $re = User::where('username',$username)->value('password');
        if($re === $password){
            $count = User::where('username',$username)->value('count');
           $result =  User::where('username',$username)->update([
                'count'=>$count+1
            ]);
           $result = $this->saveToken($username);
           return $result;
        }else{
            return ['data'=>'用户名或者密码错误'];
        }
    }

    /**存放token */
    public function saveToken($username)
    {
        $str=rand();
        $token = md5($str);
        $result = Auth::create([
            'username'=>$username,
            'token'=>$token
        ]);
        
        return $result;
    }
}