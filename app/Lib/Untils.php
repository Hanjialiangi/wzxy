<?php

namespace App\Lib;

class Untils
{

    public function searchExpress(string $expressNo, string $type)
    {
        $host = "https://wuliu.market.alicloudapi.com"; //api访问链接
        $path = "/kdi"; //API访问后缀
        $method = "GET";
        $appcode = "0a577d45939c4b36a770b579e1d50a09"; //开通服务后 买家中心-查看AppCode
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "no=" . $expressNo . '&type=' . $type;  //参数写在这里
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$" . $host, "https://")) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $out_put = curl_exec($curl);

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        list($header, $body) = explode("\r\n\r\n", $out_put, 2);
        if ($httpCode == 200) {
            //处理
            return json_decode($body);
        } else {
            if ($httpCode == 400 && strpos($header, "Invalid Param Location") !== false) {
                print("参数错误");
            } elseif ($httpCode == 400 && strpos($header, "Invalid AppCode") !== false) {
                print("AppCode错误");
            } elseif ($httpCode == 400 && strpos($header, "Invalid Url") !== false) {
                print("请求的 Method、Path 或者环境错误");
            } elseif ($httpCode == 403 && strpos($header, "Unauthorized") !== false) {
                print("服务未被授权（或URL和Path不正确）");
            } elseif ($httpCode == 403 && strpos($header, "Quota Exhausted") !== false) {
                print("套餐包次数用完");
            } elseif ($httpCode == 403 && strpos($header, "Api Market Subscription quota exhausted") !== false) {
                print("套餐包次数用完，请续购套餐");
            } elseif ($httpCode == 500) {
                print("API网关错误");
            } elseif ($httpCode == 0) {
                print("URL错误");
            } else {
                print("参数名错误 或 其他错误");
                print($httpCode);
                $headers = explode("\r\n", $header);
                $headList = array();
                foreach ($headers as $head) {
                    $value = explode(':', $head);
                    $headList[$value[0]] = $value[1];
                }
                print($headList['x-ca-error-message']);
            }
        }
    }

    public function searchIp(string $ip)
    {
        $host = "https://api01.aliyun.venuscn.com";
        $path = "/ip";
        $method = "GET";
        $appcode = "0a577d45939c4b36a770b579e1d50a09";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "ip=" . $ip;
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$" . $host, "https://")) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $out_put = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        list($header, $body) = explode("\r\n\r\n", $out_put, 2);
        return json_decode($body);
    }

    /**
     * 发送短息
     */
    public function sendMessage(string $content, string $mobile)
    {
        $host = "https://dfsns.market.alicloudapi.com";
        $path = "/data/send_sms";
        $method = "POST";
        $appcode = "0a577d45939c4b36a770b579e1d50a09";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        //根据API的要求，定义相对应的Content-Type
        array_push($headers, "Content-Type".":"."application/x-www-form-urlencoded; charset=UTF-8");
        $querys = "";
        $bodys = "content=code%3A".$content."&phone_number=".$mobile."&template_id=TPL_0000";
        $url = $host . $path;
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
        $out_put = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        list($header, $body) = explode("\r\n\r\n", $out_put, 2);
        return json_decode($body);
    }

    /**
     * 算命
     */
    public function calculate(string $birth,string $firstName,string $gender,string $lastName)
    {
        $host = "https://xuanxue.market.alicloudapi.com";
        $path = "/ai_china_knowledge/bazi/v1";
        $method = "GET";
        //阿里云APPCODE
        $appcode = "0a577d45939c4b36a770b579e1d50a09";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        array_push($headers, "Content-Type:application/json; charset=utf-8");
        
        $querys = "";
        $bodys = "";
        $url = $host . $path;
            
        //参数配置
        $parameter=array(
            "FIRST_NAME" => $firstName,
            "SECOND_NAME" => $lastName,
            "BIRTH" => $birth,
            "GENDER" => $gender
        );

        foreach($parameter as $key=>$value)
        {
            $querys .= $key . "=" . $value . "&";
        }
        $querys = substr($querys,0,-1);
        $url .= "?" . $querys;
        var_dump($url);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $out_put = curl_exec($curl);
    
        return json_decode($out_put);
    }
}
