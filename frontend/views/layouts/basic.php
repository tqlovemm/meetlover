<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
AppAsset::register($this);
$this->registerCss("
#header {width: 100%;text-align: center;font: 18px/42px microsoft yahei;overflow: hidden;}
#header .orgBg {height: 42px;background: #ff6400;overflow: hidden;}
#header .orgBg .goBack {background: url(/images/profile/goBack.png) no-repeat;background-size: 100% auto;}
#header .orgBg span {display: block;margin: 0 100px;color: #fff;}
#header .fl {float: left;width: 12px;height: 21px;margin: 12px 0 0 15px;text-indent: -999em;}
.container-fluid{padding:0;}
#function{position: absolute;top:0;right:15px;font-size:15px;}
#function_1,#function_2{background-color: transparent;border: none;color: #fff;padding:0 5px;}
");
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div id="header" style="display: block;">
        <div class="orgBg" id="headerRegOneBtn">
            <a href="javascript:void(history.back(-1))" class="fl goBack">返回</a>
            <span><?=$this->title?></span>
            <div id="function">
                <button id="function_1"></button>
                <button id="function_2"></button>
            </div>

        </div>
    </div>
    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; MeetLover <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
