<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$this->registerCss("
.navbar-brand{height:80px;padding:5px 15px;}
nav > .container-fluid{padding:0;}
.navbar-toggle .icon-bar{background-color:#000;width:30px;}
.nav > li{text-align:center;}
.navbar-nav{background-color:color:rgba(238, 238, 238, 0.61);margin-top:0;}
.navbar-brand{height:auto;padding:15px 20px;}
.wrap > .container-fluid {
    padding: 50px 0 0;
}
nav a {
    color: #000;
    font-weight:bold;
    text-decoration: none;
}
nav .active a{color:#ff6b48;}

.navbar-nav > li > a {
    padding-top: 15px;
    padding-bottom: 15px;
}


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
    <?php
    NavBar::begin([
        'brandLabel' => 'MeetLover',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-fixed-top',
            'style'=>'background-color:rgba(255, 255, 255, 0.9);',
        ],
    ]);
    $menuItems = [
        ['label' => '主页', 'url' => ['/']],
        ['label' => '关于我们', 'url' => ['about']],
        ['label' => '联系我们', 'url' => ['contact']],
    ];
 /*   if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }*/
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

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

        <p class="pull-right"><?= "苏州三十一天" ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
