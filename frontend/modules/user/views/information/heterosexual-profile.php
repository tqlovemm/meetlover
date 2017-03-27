<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = "期望对方条件";
$this->registerCss("

    label{margin-bottom:0;}
    .form-group{margin-bottom:0;}
    .help-block{margin:0 15px;}
    .weui_cell:first-child:before{display:block !important;}
");
?>

<link rel="stylesheet" href="/weui/dist/style/weui.min.css"/>
<link rel="stylesheet" href="/css/fanwei/jquery.range.css">
<script src="/js/jquery.range.js"></script>

<div class="bd">
    <div class="weui_grids">
        <?php $form = ActiveForm::begin();
        if(empty($model->heterosexual_age)){
            $model->heterosexual_age = "16,35";
        }
        if(empty($model->heterosexual_height)){
            $model->heterosexual_height = "160,185";
        }
        if(empty($model->heterosexual_weight)){
            $model->heterosexual_weight = "40,70";
        }
        ?>
        <div class="weui_cells weui_cells_form">
            <?= $form->field($model, 'heterosexual_age', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after" style="padding: 15px;">
                    <div class="weui_cell_hd">
                        <label for="range_1" class="weui_label">对方年龄</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'range-slider_1',
                ],
            ])->hiddenInput()->label(false);?>
        </div>
        <div class="weui_cells weui_cells_form">
            <?= $form->field($model, 'heterosexual_height', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after" style="padding: 15px;">
                    <div class="weui_cell_hd">
                        <label for="range_1" class="weui_label">对方身高</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'range-slider_2',
                ],
            ])->hiddenInput()->label(false);?>
        </div>
        <div class="weui_cells weui_cells_form">
            <?= $form->field($model, 'heterosexual_weight', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after" style="padding: 15px;">
                    <div class="weui_cell_hd">
                        <label for="range_1" class="weui_label">对方体重</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'range-slider_3',
                ],
            ])->hiddenInput()->label(false);?>
        </div>
        <div class="weui_cells weui_cells_form">
            <?= $form->field($model, 'heterosexual_native_place', [
                'template' => '
                <div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">对方籍贯</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList($province,['prompt'=>'请选择'])->label(false);?>
            <?= $form->field($model, 'heterosexual_education', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">对方学历</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList($education,['prompt'=>'请选择'])->label(false);?>

            <?= $form->field($model, 'heterosexual_annual_income', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">对方年薪</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList($salary,['prompt'=>'请选择'])->label(false);?>
            </div>
        <div class="weui_cells weui_cells_form">

            <?= $form->field($model, 'heterosexual_smoke', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">抽烟情况</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList($sd,['prompt'=>'请选择'])->label(false);?>

            <?= $form->field($model, 'heterosexual_drink', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">饮酒情况</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList($sd,['prompt'=>'请选择'])->label(false);?>

            <?php
                $isOnlyChild = array('1'=>'是独生子女','2'=>'非独生子女','0'=>'无要求');
            ?>
            <?= $form->field($model, 'heterosexual_only_child', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">是否独生</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList($isOnlyChild,['prompt'=>'请选择'])->label(false);?>
        </div>
        <div class="weui_btn_area">
            <?= Html::submitButton('完成', ['class' => 'weui_btn weui_btn_primary','id'=>'submit_signup','name' => 'login-button']) ?>
        </div>
        <div class="weui_cells_tips text-center" style="font-size: 12px;">确定即表示同意MeetLover<a id="vRegShowPro" href="javascript:;" class="aTxt">注册服务条款及隐私政策</a></div>
        <?php ActiveForm::end(); ?>
        <br>
    </div>
</div>
<script type="text/javascript">
    $(function(){

        $('.range-slider_1').jRange({
            from: 16,
            to: 55,
            step: 1,
            scale: [16,20,25,30,35,40,45,50,55],
            format: '%s岁',
            width: '100%',
            showLabels: true,
            isRange : true
        }); $('.range-slider_2').jRange({
            from: 145,
            to: 200,
            step: 1,
            scale: [145,155,165,175,185,195,205],
            format: '%scm',
            width: '100%',
            showLabels: true,
            isRange : true
        }); $('.range-slider_3').jRange({
            from: 35,
            to: 100,
            step: 1,
            scale: [35,50,65,80,95,110],
            format: '%skg',
            width: '100%',
            showLabels: true,
            isRange : true
        });
    });
</script>