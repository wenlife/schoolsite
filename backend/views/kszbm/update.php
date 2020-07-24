<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SignKszbm */

$this->title = '修改报名数据: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '新生报名', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="sign-kszbm-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="box box-primary">

    <!-- /.box-header -->
    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
</div>
