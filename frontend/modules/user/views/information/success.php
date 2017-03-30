<?php
$this->title = "操作成功";
$this->registerCss("

#header .orgBg{background: #000 !important;}
");
?>
<link rel="stylesheet" href="/weui/dist/style/weui.min.css"/>
<div class="weui_msg">
    <div class="weui_icon_area"><i class="weui_icon_success weui_icon_msg"></i></div>
    <div class="weui_text_area">
        <h2 class="weui_msg_title">操作成功</h2>
        <p class="weui_msg_desc">您的信息资料基本填写完成，点击确认可进入上传图片界面，上传真实图片可加深对方对你的认知。</p>
    </div>
    <div class="weui_opr_area">
        <p class="weui_btn_area">
            <a href="<?=\yii\helpers\Url::toRoute(['upload'])?>" class="weui_btn weui_btn_primary">上传个人生活照</a>
            <a href="/" class="weui_btn weui_btn_default">取消</a>
        </p>
    </div>
<!--    <div class="weui_extra_area">
        <a href="">查看详情</a>
    </div>-->
</div>
