<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SignBase */

$this->title = '新建基础信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sign-base-create">

    <h1><?= Html::encode($this->title) ?></h1>
<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title"></h3>
</div>
<div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
</div>
