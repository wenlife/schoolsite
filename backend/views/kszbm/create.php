<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;
use backend\models\SysNotice;
/* @var $this yii\web\View */
/* @var $model backend\models\SignKszbm */
$msg = SysNotice::findOne(['pos'=>'pos_kszbm']);
$this->title = '攀枝花市七中高2023届新生报名登记表';
?>
<div class="sign-kszbm-create">
    <h1 style="text-align: center; ">攀枝花第七高级中学校</h1>
    <h3 style="text-align: center;">高2023届新生报名登记表</h3>
<div class="box box-primary">
<div class="box-header with-border">
 <!--  <h1 id="show">距离报名结束：<span></span>天<span></span>小时<span></span>分<span></span>秒</h1> -->
  <?php
  if($msg)
    {
    echo Alert::widget([
      'options' => [
          'class' => $msg->level,
      ],
       'body' => $msg->content,
    ]);
    }
  ?>
</div>
<!-- /.box-header -->
<div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
</div>
