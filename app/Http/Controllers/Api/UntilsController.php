<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UntilsRepository;

class UntilsController extends Controller{

    private $untilsRepository;

    public function __construct(UntilsRepository $untilsRepository)
    {
        $this->untilsRepository = $untilsRepository;
    }

    /**
     * 查询快递
     */
    public function searchExpress(Request $request)
    {
        if(!$request->has('express_no')){
            return '请求体express_no参数不为空';
        }
        $expressNo = $request->input('express_no');
        if($request->has('type')){
            $type = $request->input("type");
        }else{
            $type = '';
        }
        return $this->untilsRepository->searchExpress($expressNo,$type);
    }

    //查询ip
    public function searchIp(Request $request)
    {
        if(!$request->has('ip')){
            return "请输入ip地址";
        }
        $ip = $request->input("ip");
        return $this->untilsRepository->searchIp($ip);
    }

    //发送短信
    public function sendMessage(Request $request)
    {
        if(!$request->has('content')){
            return '请输入短信模板';
        }
        if(!$request->has('mobile')){
            return '请输入电话号码';
        }
        $content = $request->input("content");
        $mobile = $request->input("mobile");
        return $this->untilsRepository->sendMessage($content,$mobile);
    }

    //算命
    public function calculate(Request $request)
    {
        if(!$request->has("birth"))
        {
            return "请输入出生日期";
        }
        if(!$request->has('first_name'))
        {
            return "请输入姓";
        }
        if(!$request->has("gender"))
        {
            return "请输入性别";
        }
        if(!$request->has("last_name"))
        {
            return "请输入名";
        }
        $birth = $request->input("birth");
        $firstName = $request->input("first_name");
        $gender = $request->input("gender");
        $lastName = $request->input("last_name");
        return $this->untilsRepository->calculate($birth,$firstName,$gender,$lastName);
    }
}