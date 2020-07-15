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
        <td>手机号</td>
        <td>
            <input type="text" name="user_phone" id="">
        </td>
    </tr>
    <tr>
        <td>密码</td>
        <td>
            <input type="password" name="user_pwd" id="">
        </td>
    </tr>
    <tr>
        <td></td>
        <td><input type="button" id="login" value="登录"></td>
    </tr>
</table>
</body>
</html>
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script>
    $(function () {
        $(document).on('click','#login',function () {
            var data = {};
            data.user_phone = $('input[name=user_phone]').val();
            data.user_pwd = $('input[name=user_pwd]').val();
            $.ajax({
                data:data,
                dataType: 'json',
                type:'post',
                url:'/login/do_login',
                success:function (res) {
                    if(res.errno == '0'){
                        alert(res.msg);
                        location.href = '/test/add';
                    }else{
                        alert(res.msg);
                    }
                }
            });
        })
    })
</script>
