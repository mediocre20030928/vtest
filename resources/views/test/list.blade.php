<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table border="1">
    <tr>
        <td>姓名</td>
        <td>地址</td>
        <td>联系电话</td>
        <td>操作</td>
    </tr>
    @foreach($arr as $k => $v)
    <tr>
        <td>{{$v->people}}</td>
        <td>{{$v->address}}</td>
        <td>{{$v->phone}}</td>
        <td>
            <a href="javascript:void (0)" id="del" data-id={{$v->id}}>删除</a>
            <a href="{{url('/test/upd/'.$v->id)}}" >修改</a>
            @if($v->is_checked == 0)
            <button id="upd_check" data-id={{$v->id}} >设置默认收获地址</button>
            @else
                <font color="red">默认收货地址</font>
             @endif
        </td>
    </tr>
    @endforeach
</table>
</body>
</html>
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script>
    $(function () {
        $(document).on('click','#del',function(){
            var re = confirm("删?");
            if(re == true){
                var id = $(this).attr('data-id');
                $.ajax({
                    data:{id:id},
                    type:'post',
                    dataType:'json',
                    url:'/test/del',
                    success:function (res) {
                        if(res.errno == '0'){
                            location.href = '/test/list';
                        }
                    }
                })
            }
        });

        $(document).on('click','#upd_check',function(){
                var id = $(this).attr('data-id');
            $.ajax({
                data:{id:id},
                type:'post',
                dataType:'json',
                url:'/test/upd_check',
                success:function (res) {
                    if(res.errno == '0'){
                        location.href = '/test/list';
                    }
                }
            })
        });
    })
</script>
