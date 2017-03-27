<?php
$this->title = "图片上传";
$this->registerCss("

        ul, ol{margin-bottom:0;}
        
        .z_mask {
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, .5);
            
            position: fixed;
            top: 0;
            left: 0;
            z-index: 999;
            display: none;
        }
        
        .z_alert {
            width: 200px;
            height: 100px;
            border-radius: 2px;
            background: #fff;
            font-size: 14px;
            text-align: center;
            position: absolute;
            left: 50%;
            margin-left:-100px;
            top: 50%;
            margin-top: -50px;
        }
        
        .z_alert div:nth-child(1) {
            line-height: 50px
        }
        
        .z_alert div:nth-child(2) span {
            display: inline-block;
            width: 50%;
            height: 50px;
            line-height: 50px;
            float: left;
            border-top: 1px solid #ddd;
        }
        
        .z_cancel {
            border-right: 1px solid #ddd;
        }
");
$pre_url = "http://omu5j530t.bkt.clouddn.com/";
?>
<link rel="stylesheet" href="/weui/dist/style/weui.min.css"/>
<div class="weui_cells weui_cells_form">
    <div class="weui_cell">
        <div class="weui_cell_bd weui_cell_primary">
            <div class="weui_uploader container">
                <div class="weui_uploader_hd weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">图片上传</div>
                    <div class="weui_cell_ft">最多9张</div>
                </div>
                <div class="weui_uploader_bd">
                    <div class="weui_uploader_files"></div>
                    <!--<form action="upload-image" id="uform" method="post" enctype="multipart/form-data">-->
                    <form id="uploadForm" enctype="multipart/form-data">
                        <input type="hidden" name="_csrf-frontend" value="<?=Yii::$app->request->getCsrfToken()?>">
                        <div class="weui_uploader_input_wrp">
                            <input class="weui_uploader_input" type="file" id="file" name="files[]" accept="image/*" multiple onchange="doUpload()" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="z_mask">
    <!--弹出框-->
    <div class="z_alert">
        <div>确定要删除这张图片吗？</div>
        <div>
            <span class="z_cancel">取消</span>
            <span class="z_sure">确定</span>
        </div>
    </div>
</div>
<script>

    function doUpload() {
        var formData = new FormData($( "#uploadForm" )[0]);
        $.ajax({
            url: 'upload-image' ,
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (returndata) {
                var imgCon = $('.weui_uploader_files');
                imgCon.append(returndata);
            },
            error: function (returndata) {
                console.log(returndata);
            }
        });
    }

    function imgRemove(id,con) {
        var img = $(con);
        if(confirm('确定删除吗')){
            img.remove();
            $.get('delete-img?id='+id);
            $('.weui_uploader_input_wrp').show();
        }
    }
</script>