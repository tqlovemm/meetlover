<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = "完善资料";
$this->registerCss("

    label{margin-bottom:0;}
    .form-group{margin-bottom:0;}
    .help-block{margin:0 15px;}
    .weui_cell:first-child:before{display:block !important;}

");
?>
<link rel="stylesheet" href="/weui/dist/style/weui.min.css"/>
<div class="bd">
    <div class="weui_grids">

        <?php $form = ActiveForm::begin();?>
        <div class="weui_cells weui_cells_form">
        <?= $form->field($user, 'username', [
            'template' => '<div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">昵称</label></div>
            <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
            'inputOptions' => [
                'class'=>'weui_input',
                'placeholder'=>'请输入昵称',
            ],
        ])->label(false);?>
        </div>
        <div class="weui_cells weui_cells_form">
            <?= $form->field($profile, 'age', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">年龄</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList($ageChoice,['prompt'=>'请选择'])->label(false);?>
            <?= $form->field($profile, 'height', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">身高</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList($heightChoice,['prompt'=>'请选择'])->label(false);?>

            <?= $form->field($profile, 'weight', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">体重</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList($weightChoice,['prompt'=>'请选择'])->label(false);?>
        </div>

        <div class="weui_cells weui_cells_form">

            <?= $form->field($profile, 'constellation', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">星座</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList($constellation,['prompt'=>'请选择'])->label(false);?>

            <?= $form->field($profile, 'education', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">学历</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList($education,['prompt'=>'请选择'])->label(false);?>
            <?= $form->field($profile, 'annual_salary', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">年薪</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList($salary,['prompt'=>'请选择'])->label(false);?>
        </div>

        <div class="weui_cells weui_cells_form">
            <?= $form->field($profile, 'native_country', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">国家</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList([10000000=>'中国'])->label(false);?>

            <?= $form->field($profile, 'native_province', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">省份</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList($province,[
                'prompt'=>'请选择省份',
                'onchange'=>'$.post("lists?id='.'"+$(this).val(),function(data){
                $("select#userprofile-native_city").html(data);
            });',
            ])->label(false);?>

            <?= $form->field($profile, 'native_city', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">城市</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList([],['prompt'=>'请选择城市'])->label(false);?>
        </div>

        <div class="weui_cells weui_cells_form">

            <?= $form->field($profile, 'marry', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">婚姻情况</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList($marry,['prompt'=>'请选择'])->label(false);?>
            <?= $form->field($profile, 'somke', [
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

            <?= $form->field($profile, 'drink', [
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
        </div>

        <div class="weui_cells weui_cells_form">

            <?= $form->field($profile, 'job', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">工作职业</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList($job,['prompt'=>'请选择'])->label(false);?>

            <?= $form->field($profile, 'hope_marry_time', [
                'template' => '<div class="weui_cell weui_cell_select weui_select_after">
                    <div class="weui_cell_hd">
                        <label for="" class="weui_label">期望婚期</label>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">{input}</div>
                </div>{error}',
                'inputOptions' => [
                    'class'=>'weui_select',
                ],
            ])->dropDownList($marryTime,['prompt'=>'请选择'])->label(false);?>
        </div>
        <div class="weui_cells weui_cells_form">
            <?= $form->field($profile, 'only_child')->checkbox([
                'template' => '<div class="weui_cell weui_cell_switch">
                    <div class="weui_cell_hd weui_cell_primary">是否是独生子女</div>
                    <div class="weui_cell_ft">{input}</div>
                </div>',
                'class'=>'weui_switch',
            ])->label(false);?>
        </div>

        <div class="weui_cells weui_cells_form">
            <?= $form->field($profile, 'say_to_him', [
                'template' => '<div class="weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">{input}<div class="weui_textarea_counter"><span>0</span>/200</div></div>
                </div>',
                'inputOptions' => [
                    'class'=>'weui_textarea',
                ],
            ])->textarea(['placeholder'=>'请输入你想对TA说的话'])->label(false);?>
        </div>

        <div class="weui_btn_area">
            <?= Html::submitButton('下一步', ['class' => 'weui_btn weui_btn_primary','id'=>'submit_signup','name' => 'login-button']) ?>
        </div>
        <div class="weui_cells_tips text-center" style="font-size: 12px;">确定即表示同意MeetLover<a id="vRegShowPro" href="javascript:;" class="aTxt">注册服务条款及隐私政策</a></div>
        <?php ActiveForm::end();?>
        <br>
    </div>
</div>
<script>
    $(function () {
        $('.weui_textarea_counter span').html($('.weui_textarea').val().length);
        $('.weui_textarea',this).keyup(function () {
            $(this).siblings('.weui_textarea_counter').children('span').html( $(this).val().length);
        });
    });
</script>