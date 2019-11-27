<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\models\Indexsetting;
backend\assets\AppAsset::register($this);
dmstr\web\AdminLteAsset::register($this);
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
<body class="hold-transition skin-blue layout-top-nav">
<?php $this->beginBody() ?>

<div class="content-wrapper">
<?php
NavBar::begin([
    'brandLabel' => '攀枝花七中校内网',
    'brandUrl' =>'http://www.pzhqz.com', //Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-static-top navbar-custom',
    ],
]);

echo Nav::widget([
    'items'=>[
            ['label'=>'个人中心','url'=>['/tcenter/index']],
            ['label'=>'班级课表','url'=>['/tcenter/bcourse']],
            ['label'=>'学校校历','url'=>['/tcenter/cal']],
    ],
    'options'=>['class'=>'navbar-nav'],
]);
$menuItems = [

['label'=>'管理中心','url'=>['tcenter/mcenter'],'visible'=>Yii::$app->user->can('schoolPost')],
];

if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
    $menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
} else {
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            '<span class="fa  fa-power-off"> 退出</span> (' . Yii::$app->user->identity->username . ')',
           // ['class' => 'btn btn-link','style'=>'height:50px;']
            ['class' => 'btn btn-link','style'=>'line-height:20px;color:#fff']
        )
        . Html::endForm()
        . '</li>';
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();
?>
<div class="container">    
<div class="row">
    <section class="content-header">
    <?=
    Breadcrumbs::widget(
        [
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]
    ) ?>
    </section>
    <section class="content">
    <?= Alert::widget() ?>
    <p></p>
    <?= $content ?>
</section>
</div>
</div>
</div>
<div class="main-footer">
    <div class="container">
        <p class="text-center">攀枝花七中信息技术教研组 All Right Reserved</p>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
