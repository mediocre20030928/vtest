<?php

namespace App\Http\Controllers;
use App\models\sendMsg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function reg(){
        return view('login.reg');
    }

    public function do_reg(Request $request){
        $user_phone = $request->user_phone;
        $now_time = time();
        $codeinfo = DB::table('code')->where('phone',$user_phone)->first();
        if($codeinfo){
            if($codeinfo->send_time){
                if($now_time - $codeinfo->send_time >= 300){
                    echo json_encode(['errno'=>00001,'msg'=>'验证码过期']);
                    DB::table('code')->where('phone',$user_phone)->delete();
                    exit;
                }
            }
        }
        $sendmsg = new sendMsg();
        $send = $sendmsg->send($user_phone);
        $send = json_decode($send);
        if($send->return_code == "00000"){
            echo json_encode(['errno'=>00000,'msg'=>'短信验证码发送成功!请注意查收!']);
        }else{
            echo json_encode(['errno'=>00001,'msg'=>'短信验证码发送失败,请重试!']);
            exit;
        }
    }
    public function go_reg(Request $request){
        $user_phone = $request->user_phone;
        $user_pwd = $request->user_pwd;
        $code = $request->code;
        $once = DB::table('user')->where('user_phone',$user_phone)->first();
        if(empty($once)){
            $codetrue = DB::table('code')->where('phone',$user_phone)->first();
            if($codetrue->code != $code){
                echo json_encode(['errno'=>00001,'msg'=>'验证码错误!']);
                exit;
            }else{
                $arr = array(
                    'user_phone'=>$user_phone,
                    'user_pwd'=>md5($user_pwd),
                );
                $res = DB::table('user')->insert($arr);
                if($res){
                    echo json_encode(['errno'=>00000,'msg'=>'注册成功!!']);
                }else{
                    echo json_encode(['errno'=>00001,'msg'=>'注册失败!!']);
                    exit;
                }
            }
        }else{
            echo json_encode(['errno'=>00001,'msg'=>'该手机号已经注册!']);
            exit;
        }

    }

    public function login(){
        return view('login.login');
    }
    public function do_login(Request $request){
        $user_phone = $request->user_phone;
        $user_pwd = $request->user_pwd;
        $now_time = time();
        $userinfo = DB::table('user')->where('user_phone',$user_phone)->first();
        if($userinfo->error == 3){
            if($now_time - $userinfo->last_error_time <= 3600){
                echo json_encode(['errno'=>00001,'msg'=>'您的账号已被锁定!']);
                die;
            }
        }
        if(md5($user_pwd) != $userinfo->user_pwd){
            if($userinfo->error == 3){
                if($now_time - $userinfo->last_error_time <= 3600){
                    echo json_encode(['errno'=>00001,'msg'=>'您的账号已被锁定!']);
                    die;
                }
            }
            echo json_encode(['errno'=>00001,'msg'=>'密码错误!']);
            $arr = array(
                'last_error_time'=>time(),
                'error' => $userinfo->error + 1,
            );
            DB::table('user')->where('user_phone',$user_phone)->update($arr);
            exit;
        }else{
            Session::put('userinfo',$userinfo);
            echo json_encode(['errno'=>00000,'msg'=>'登录成功!']);
        }
    }

}
