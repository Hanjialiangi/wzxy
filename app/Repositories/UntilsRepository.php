<?php

namespace App\Repositories;

use Czim\Repository\BaseRepository;
use App\Lib\Untils;
use App\Models\Express;

class UntilsRepository extends BaseRepository
{

    public function model()
    {
        return Express::class;
    }

    /**
     * 查询快递
     * 
     */
    public function searchExpress($expressNo, $type)
    {
        $untils = new Untils;
        $result = $untils->searchExpress($expressNo, $type);
        if ($result->status === '0') {
            //处理
            $data = $result->result;
            $exist = Express::where('express_no', $data->number)->first();
            if ($exist) {
                $exist->type = $data->type;
                $exist->express_no = $data->number;
                $exist->exp_name = $data->expName;
                $exist->exp_site = $data->expSite;
                $exist->exp_phone = $data->expPhone;
                $exist->courier = $data->courier;
                $exist->courier_phone = $data->courierPhone;
                $exist->update_time = $data->updateTime;
                $exist->take_time = $data->takeTime;
                $exist->is_sign = $data->issign;
                $exist->delivery_status = $data->deliverystatus;
                $exist->detail = json_encode($data->list);
            } else {
                $model = Express::create([
                    'type' => $data->type,
                    'express_no' => $data->number,
                    'exp_name' => $data->expName,
                    'exp_site' => $data->expSite,
                    'exp_phone' => $data->expPhone,
                    'courier' => $data->courier,
                    'courier_phone' => $data->courierPhone,
                    'update_time' => $data->updateTime,
                    'take_time' => $data->takeTime,
                    'is_sign' => $data->issign,
                    'delivery_status' => $data->deliverystatus,
                    'detail' => json_encode($data->list)
                ]);
                if (!$model) {
                    return '模型创建失败！';
                }
            }
        }
        return $result;
    }
}
