<?php

namespace App\Lib;

use Dingo\Api\Http\Response\Format\Json;

/**
 * JSON响应格式处理
 */
class JSONResponseFormat extends Json
{
    protected function encode($content)
    {
        //响应返回值的data属性值
        if (!empty($content['no_response_wrapper'])) {
            return json_encode($content['data'], JSON_UNESCAPED_UNICODE);
        }

        //将响应值的status_code重命名为code
        if (isset($content['status_code'])) {
            $content['code'] = $content['status_code'];
            unset($content['status_code']);
            if (!isset($content['data'])) {
                $content['data'] = json_decode('{}');
            }
            return json_encode($content, JSON_UNESCAPED_UNICODE);
        }

        //常规响应结构
        return json_encode(
            [
                'code' => 200,
                'data' => $content,
                'message' => 'ok',
            ],
            JSON_UNESCAPED_UNICODE,
        );
    }
}
