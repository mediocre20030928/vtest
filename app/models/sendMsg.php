<?php
namespace App\models;

e Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class sendMsg extends Model
{ss
    public function send($phone){
        $host = "http://dingxin.market.alicloudapi.com";
        $path = "/dx/sendSms";
        $method = "POST";
        $appcode = "d446a015f446415d92536a0a940fb20d";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $code = rand(10000,99999);
        $querys = "mobile=$phone&param=code%3A$code&tpl_id=TP1711063";
        $bodys = "";
        $url = $host . $path . "?" . $querys;
                $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $arr = array(
            'code'=>$code,
            'send_time'=>time(),
            'phone'=>$phone
        );
        DB::table('code')->insert($arr);
        return curl_exec($curl);
    }
}
