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
}