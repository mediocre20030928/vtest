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
        <td>验证码</td>
        <td>
            <input type="text" name="code" id="">
            <button id="send">发送短信验证码</button>
        </td>
    </tr>
    <tr>
        <td></td>
        <td><input type="button" id="reg" value="注册"></td>
    </tr>
</table>
</body>
</html>
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script>
    $(function(){
        $(document).on('click','#send',function(){
            var data = {};
            data.user_phone = $('input[name=user_phone]').val();
            if(!(/^1([38]\d|4[5-9]|5[0-35-9]|6[56]|7[0-8]|9[189])\d{8}$/.test(data.user_phone))){
                alert("手机号码有误，请重填");
                return false;
            }else if(data.user_phone == ""){
                alert("手机号不能为空!!");
                return false;
            }else{
                resetTime();
                $.ajax({
                    data:data,
                    type:'post',
                    dataType:'json',
                    url:'/login/do_reg',
                    success:function(res){
                        if(res.errno == '00000'){
                            alert(res.msg);
                        }else{
                            alert(res.msg);
                        }
                    }
                });
            }
        });

        $(document).on('click','#reg',function(){
            var data = {};
            data.user_phone = $('input[name=user_phone]').val();
            data.user_pwd = $('input[name=user_pwd]').val();
            data.code = $('input[name=code]').val();
            $.ajax({
                data:data,
                dataType: 'json',
                type:'post',
                url:'/login/go_reg',
                success:function (res) {
                    if(res.errno == '0'||'00000'){
                        alert(res.msg);
                        location.href = '/login/login';
                    }
                }
            });
        })

        function resetTime(){
            var second = 60;
            var timer = null;
            timer = setInterval(function(){
                second -= 1;
                if(second >0){
                    $('#send').attr('disabled',true);
                    $('#send').text(second + "秒后获取验证码");
                }else{
                    clearInterval(timer);
                    $('#send').attr('disabled',false);
                    $('#send').text("发送短信验证码");
                }
            },1000);
        }
    });
</script>
