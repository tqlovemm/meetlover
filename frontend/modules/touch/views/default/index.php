<?php $this->registerCss("

    .slideBox{ position:relative; overflow:hidden; margin:10px auto;  max-width:560px;/* 设置焦点图最大宽度 */ }
	.slideBox .hd{ position:absolute; height:28px; line-height:28px; bottom:0; right:0; z-index:1; }
	.slideBox .hd li{ display:inline-block; width:5px; height:5px; -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; background:#333; text-indent:-9999px; overflow:hidden; margin:0 6px;   }
	.slideBox .hd li.on{ background:#fff;  }
	.slideBox .bd{ position:relative; z-index:0; }
	.slideBox .bd li{ position:relative; text-align:center;  }
	.slideBox .bd li img{ background:url(images/loading.gif) center center no-repeat;  vertical-align:top; width:100%;/* 图片宽度100%，达到自适应效果 */}
	.slideBox .bd li a{ -webkit-tap-highlight-color:rgba(0,0,0,0);  }  /* 去掉链接触摸高亮 */
	.slideBox .bd li .tit{ display:block; width:100%;  position:absolute; bottom:0; text-indent:10px; height:28px; line-height:28px; background:url(images/focusBg.png) repeat-x; color:#fff;  text-align:left;  }
	
");?>
<script src="/js/TouchSlide.1.1.js"></script>
<div class="touch-default-index" style="max-width: 750px;margin: auto;">
    <div id="slideBox" class="slideBox">

        <div class="bd">
            <ul>
                <li>
                    <a class="pic" href="#"><img src="/images/touch/home/1.png" /></a>
                    <!--<a class="tit" href="#">墨西哥教师罢工 与警察激烈冲突</a>-->
                </li>
                <li>
                    <a class="pic" href="#"><img src="/images/touch/home/2.png"/></a>
                   <!-- <a class="tit" href="#">日右翼游行纪念钓岛"国有化"周年</a>-->
                </li>
                <li>
                    <a class="pic" href="#"><img src="/images/touch/home/3.png"/></a>
                    <!--<a class="tit" href="#">女兵竞选美国小姐鼓励女性自强</a>-->
                </li>
            </ul>
        </div>

        <div class="hd">
            <ul></ul>
        </div>
    </div>
    <script type="text/javascript">
        TouchSlide({
            slideCell:"#slideBox",
            titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
            mainCell:".bd ul",
            effect:"leftLoop",
            autoPage:true,//自动分页
            autoPlay:true //自动播放
        });
    </script>
    <img class="img-responsive" src="/images/touch/home/1real.png">
    <img class="img-responsive" src="/images/touch/home/166742106568988594.png">
    <img class="img-responsive" src="/images/touch/home/3kefu.png">
    <img class="img-responsive" src="/images/touch/home/540294840207097157.png">
    <div class="body-content" style="width: 100%;height:450px;padding-top:14%;background-image: url('/images/touch/home/ditu.png');background-repeat: no-repeat;background-size: contain;background-position: center;">
        <div style="width: 100%;margin:0 auto;padding:20px;background-color: rgba(221, 221, 221, 0.53);">
            <?=$this->render('@app/views/site/_signupForm',['model'=>$model]) ?>
        </div>
    </div>
</div>
