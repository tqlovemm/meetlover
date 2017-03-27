<?php
use yii\helpers\Url;
$this->title = 'MeetLover';
$this->registerCss("
    #banner {position: relative;margin-top:10px; overflow:hidden;}
    #banner_list img {border: 0px;}
    #banner_list a { position: absolute; }
    #banner a.btn:hover{background-color:yellow !important;}
");
?>

<script type="text/javascript">
    var t = n =0, count;
    $(document).ready(function(){

        count=$("#banner_list a").length;

        $("#banner_list a:not(:first-child)").hide();

        $("#banner_info").html($("#banner_list a:first-child").find("img").attr('alt'));

        $("#banner_info").click(function(){window.open($("#banner_list a:first-child").attr('href'), "_blank")});

        $("#banner li").click(function() {

            var i = $(this).text() -1;//获取Li元素内的值，即1，2，3，4

            n = i;

            if (i >= count) return;

            $("#banner_info").html($("#banner_list a").eq(i).find("img").attr('alt'));

            $("#banner_info").unbind().click(function(){window.open($("#banner_list a").eq(i).attr('href'), "_blank")})

            $("#banner_list a").filter(":visible").fadeOut(500).parent().children().eq(i).fadeIn(1000);

            document.getElementById("banner").style.background="";

            $(this).toggleClass("on");

            $(this).siblings().removeAttr("class");

        });

        t = setInterval("showAuto()", 4000);

        //$("#banner").hover(function(){clearInterval(t)}, function(){t = setInterval("showAuto()", 3000);});

    })
    function showAuto() {
        n = n >=(count -1) ?0 : ++n;
        $("#banner li").eq(n).trigger('click');
    }
    $(function () {
        $("#banner").height($("#banner_list img").height());
    });
</script>
<div class="site-index">
    <div style="display: block;height: inherit;" class="clearfix">
        <div id="banner">
            <ul style="display: none;height: inherit;">
                <li class="on">1</li><li>2</li><li>3</li><li>4</li>
            </ul>
            <div id="banner_list" class="clearfix">
                <a href="#"><img class="img-responsive" src="/images/home/1.jpg" title="meetlover" alt="meetlover"/></a>
                <a href="#"><img class="img-responsive" src="/images/home/2.jpg" title="meetlover" alt="meetlover"/></a>
                <a href="#"><img class="img-responsive" src="/images/home/3.jpg" title="meetlover" alt="meetlover"/></a>
            </div>
            <a href="<?=Url::toRoute(['contact'])?>" class="btn" style="position:absolute;top:70%;left:50%;margin-left:-83px;border-radius: 30px;font-size: 20px;font-weight: bold;color: #000;padding:10px 40px;background-color: #fff;">即刻加入</a>
        </div>
    </div>
    <div class="body-content">
       <img class="img-responsive" src="/images/home/1real.png">
       <img class="img-responsive" src="/images/home/2pipei.png">
       <img class="img-responsive" src="/images/home/3kefu.png">
    </div>

    <div class="body-content" style="width: 100%;height:750px;padding-top:14%;background-image: url('/images/home/ditu.jpg');background-repeat: no-repeat;background-size: cover;background-position: center;">
        <div style="width: 25%;margin:0 auto;padding:20px;">
            <?=$this->render('_signupForm',['model'=>$model]) ?>
        </div>
    </div>
</div>
