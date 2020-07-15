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
<table>
    <tr>
        <td>收货人</td>
        <td>
            <input type="text" name="people" value="{{$arr->people}}">
        </td>
    </tr>
    <tr>
        <td>详细地址</td>
        <td>
            <input type="text" name="address" value="{{$arr->address}}">
        </td>
    </tr>
    <tr>
        <td>联系电话</td>
        <td>
            <input type="text" name="phone" id=""  value="{{$arr->phone}}">
        </td>
    </tr>
    <tr>
        <td>邮箱</td>
        <td>
            <input type="text" name="email" id="" value="{{$arr->email}}">
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="button" value="修改" id="upd">
            <input type="hidden" name="id"  value="{{$arr->id}}">
        </td>
    </tr>
</table>
</body>
</html>
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script>
    $(function () {
        $(document).on('click','#upd',function(){
            var data = {};
            data.id = $('input[name=id]').val();
            data.people = $('input[name=people]').val();
            data.address = $('input[name=address]').val();
            data.phone = $('input[name=phone]').val();
            data.email = $('input[name=email]').val();
            $.ajax({
                data:data,
                type:'post',
                dataType:'json',
                url:'/test/do_upd',
                success:function (res) {
                    if(res.errno == '0'){
                        location.href = '/test/list';
                    }
                }
            })
        });


    })
</script>

