<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->registerCss("

    .form-signup {padding: 15px;margin: 0 auto;}
    .form-signup .form-signup-heading,.form-signup .checkbox {margin-bottom: 10px;}
    .form-signup .checkbox {font-weight: normal;}
    .form-signup .form-control {position: relative;height: auto;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px;font-size: 16px;}
    .form-signup .form-control:focus {z-index: 2;}
    .form-signup input[type='email'] {margin-bottom: -1px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;}
    .form-signup input[type='password'] {margin-bottom: 10px;border-top-left-radius: 0;border-top-right-radius: 0;}
    .field-signupform-smscode{width:60%;float:left;margin-bottom:0;}
    .field-signupform-sms_code p{margin-bottom:0;}
    #second{float:left;width:30%;font-size:12px;}
    .field-signupform-sms_code{width:70%;float:left;margin-bottom:0;}
    .input-group input,.form-group input,.input-group-addon{border:none;background-color:rgba(13, 13, 13, 0.7);color:#fff;border-radius:0;height:44px;}
    #signupform-sms_code{border-right:1px solid #5f5f5f;}
    .btn{padding:7px 12px;}
    #second.btn:hover{color:#F5C354;}
    .input-group-addon{font-size:18px;}
    .has-error .input-group-addon{background-color:rgba(13, 13, 13, 0.7);}

");
?>
<div class="row">
    <div class="col-lg-12">

        <?php $form = ActiveForm::begin(['id'=>'index']); ?>
        <div class="form-group has-feedback">
            <?= $form->field($model, 'cellphone', [
                'template' => '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>{input}</div>{error}',
                'inputOptions' => [
                    'placeholder' => "手机号",
                ],
            ])->label(false);?>
        </div>
        <div class="form-group has-feedback clearfix">

            <?= $form->field($model, 'sms_code', [
                'template' => '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>{input}</div>{error}',
                'inputOptions' => [
                    'placeholder' => "验证码",
                ],
            ])->label(false);?>
            <?= Html::buttonInput('获取验证码', ['class' => 'btn', 'id' => 'second']) ?>

        </div>
        <div class="form-group has-feedback">
            <?= $form->field($model, 'password', [
                'template' => '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>{input}</div>{error}',
                'inputOptions' => [
                    'placeholder' => "密码",
                ],
            ])->passwordInput()->label(false);?>
        </div>
        <!--<p>注册即视为同意<a style='color:red;' href='/attention/disclaimers'>《用户使用协议》</a></p>-->
        <div class="form-group">
            <?= Html::submitButton('注册', ['class' => 'btn btn-primary','id'=>'submit_signup', 'style'=>'border-color:#F5C354;background-color:#F5C354;width:100%;padding: 5px 0;font-size:20px;','name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<script>

    function addCookie(name,value,expiresHours){
        var cookieString=name+"="+escape(value); //判断是否设置过期时间,0代表关闭浏览器时失效
        if(expiresHours>0){
            var date=new Date();
            date.setTime(date.getTime()+expiresHours*1000);
            cookieString=cookieString+";expires=" + date.toUTCString();
        }
        document.cookie=cookieString;
    }
    //修改cookie的值
    function editCookie(name,value,expiresHours){
        var cookieString=name+"="+escape(value);
        if(expiresHours>0){
            var date=new Date();
            date.setTime(date.getTime()+expiresHours*1000); //单位是毫秒
            cookieString=cookieString+";expires=" + date.toGMTString();
        }
        document.cookie=cookieString;
    }//根据名字获取cookie的值

    function getCookieValue(name){
        var strCookie=document.cookie;
        var arrCookie=strCookie.split("; ");
        for(var i=0;i<arrCookie.length;i++){
            var arr=arrCookie[i].split("=");
            if(arr[0]==name){
                return unescape(arr[1]);
                break;
            }
        }
    }

    window.onload=function(){

        $("#submit_signup").click(function () {
            var site = 'http://meetlover1314.com/site/';
            var mobile = $("#signupform-cellphone").val();
            var code = $("#signupform-sms_code").val();
            var send = doPostBack(site + 'verification-mobile-code', {'mobile': mobile,'code':code});
            if(!send){
               return false;
            }
        });

        $("#second").click(function (){
            sendCode($("#second"));
        });

        v = getCookieValue("meet_lover_login") ? getCookieValue("meet_lover_login") : 0;//获取cookie值
        if(v>0){
            settime($("#second"));//开始倒计时
        }

    };

    function sendCode(obj){
        var site = 'http://meetlover1314.com/site/';
        var mobile = $("#signupform-cellphone").val();    //检查手机是否合法
        if(isPhoneNum(mobile)){
            var exists_result = dbCheckMobileExists(site+'check-mobile-exists',{"mobile":mobile});
            if(exists_result) {
                var send = doPostBack(site + 'send-code', {'mobile': mobile});
                if(send){
                    addCookie('meet_lover_login', 10, 10);//添加cookie记录,有效时间60s
                    settime(obj);//开始倒计时
                }
            }
        }
    }

    function doPostBack(url,queryParam) {
        var exist_01 = false;
        $.ajax({
            cache : false,
            type : 'POST',
            async : false,
            url : url,
            dataType:'text',
            data:queryParam,
            error : function(){
            },
            success:function(result){
                var parsedJson = $.parseJSON(result);
                if(parsedJson.statusCode==0){
                    exist_01 = true;
                }else {
                    alert(parsedJson.statusMsg);
                }

            }
        });
        return exist_01;
    }//开始倒计时
    var countdown;
    function settime(obj) {
        countdown = getCookieValue('meet_lover_login') ? getCookieValue('meet_lover_login') : 0;
        if (countdown == 0) {
            obj.removeAttr('disabled');
            obj.val("获取验证码");
            return;
        } else {
            obj.attr('disabled', true);
            obj.val(countdown + "秒后重发");
            countdown--;
            editCookie("meet_lover_login", countdown, countdown + 1);
        }
        setTimeout(function () {
            settime(obj)
        }, 1000); //每1000毫秒执行一次
    }
    function dbCheckMobileExists(url,queryParam){
        var exist = false;
        $.ajax({
            async : false,
            cache : false,
            type : 'POST',
            url : url,// 请求的action路径
            data:queryParam,
            error : function() {// 请求失败处理函数
            },
            success:function(result){
                var parsedJson = $.parseJSON(result);
                if(parsedJson.error_code==0){
                    exist = true;
                }else{
                    alert(parsedJson.error_msg);
                }
            }
        });
        return exist;
    }
    function isPhoneNum(obj){
        var myreg = /^(((13[0-9]{1})|(14[0-9]{1})|(15[0-9]{1})|(16[0-9]{1})|(17[0-9]{1})|(18[0-9]{1})|(19[0-9]{1}))+\d{8})$/;
        if(!myreg.test(obj)){
            alert('请输入有效的手机号码！');
            $("#signupform-cellphone").focus();
            return false;
        }else{
            return true;
        }
    }
</script>