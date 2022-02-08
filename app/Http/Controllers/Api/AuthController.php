<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AuthRepository;

class AuthController extends Controller{

    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * 登陆
     */
    public function login(Request $request)
    {
        return $this->authRepository->login($request);
    }
}