<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FastController extends Controller
{
    public function add(){
        return view('test.add');
    }

    public function do_add(Request $request){
        $arr = $request->all();
        $res = DB::table('test')->insert($arr);
        if($res){
            echo json_encode(['errno'=>00000,'msg'=>'添加成功!!']);
        }else{
            echo json_encode(['errno'=>00001,'msg'=>'添加失败!!']);
            exit;
        }
    }

    public function list(){
        $arr = DB::table('test')->where('is_del','0')->get();
        return view('test.list',['arr'=>$arr]);
    }
    public function del(Request $request){
        $id = $request->id;
        $res = DB::table('test')->where('id',$id)->update(['is_del'=>'1']);
        if($res){
            echo json_encode(['errno'=>'0','msg'=>'删除成功']);
        }else{
            echo json_encode(['errno'=>'1','msg'=>'删除失败']);die;
        }
    }
    public function upd(Request $request){
        $id = $request->id;
        $arr = DB::table('test')->where('id',$id)->first();
        return view('test.upd',['arr'=>$arr]);
    }

    public function do_upd(Request $request){
        $id = $request->id;
        $arr = $request->except('id');
        $res = DB::table('test')->where('id',$id)->update($arr);
        if($res){
            echo json_encode(['errno'=>'0','msg'=>'修改成功']);
        }else{
            echo json_encode(['errno'=>'1','msg'=>'修改失败']);die;
        }
    }

    public function upd_check(Request $request){
        $id = $request->id;
        DB::table('test')->where('is_checked','1')->update(['is_checked'=>'0']);
        DB::table('test')->where('id',$id)->update(['is_checked'=>'1']);
        echo json_encode(['errno'=>'0']);
    }
}
