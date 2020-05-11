<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\web\Session;
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
    <meta name="renderer" content="webkit">
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
<?php
$session = new Session;
$session->open();
$filepath = 'counter.txt';
if (!file_exists($filepath))//检查文件是否存在，不存在刚新建该文件并赋值为0
{
    $fp = fopen($filepath,'w');
    fwrite($fp,0);
    fclose($fp);
    counter($filepath);
}
if (!$session->get('temp'))//判断$_SESSION[temp]的值是否为空,其中的temp为自定义的变量
{
    counter($filepath);
    $session->set('temp',1);
}
//$session->destroy();

//counter()方法用来得到文件内的数字

function counter($f_value)
{
 //用w模式打开文件时会清空里面的内容，所以先用r模式打开，取出文件内容，保存到变量
 $fp = fopen($f_value,'r') or die('打开文件时出错。');
 $countNum = fgets($fp,1024);
 fclose($fp);
 $countNum++;
 $fpw = fopen($f_value,'w');
 fwrite($fpw,$countNum);
 fclose($fpw);
}
?>
<div class="main-footer">
    <div class="container">
        <p class="text-center">攀枝花七中信息技术教研组 All Right Reserved</p>
        <?='<p style="text-align:center">您是本站第'.file_get_contents('counter.txt').'位访客(Since 2020-05-11)</p>';?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

