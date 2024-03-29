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
    'brandLabel' => '攀枝花七中校园网',
    'brandUrl' =>'http://www.pzhqz.com', //Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-static-top navbar-custom',
    ],
]);

echo Nav::widget([
    'items'=>[
        ['label'=>'艺体招生报名','url'=>['/signsheet/create']],
        ['label'=>'艺体报名查询','url'=>['/signsheet/query']],
    ],
    'options'=>['class'=>'navbar-nav'],
]);
$menuItems = [

];

if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];

} else {
    $menuItems[] =['label'=>'报名管理','url'=>['/signsheet'],'visible'=>Yii::$app->user->can('userPost')];
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link']
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
        <p class="text-center">攀枝花七中信息技术教研组</p>
        <p class="text-center">Yii powerd</p>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
