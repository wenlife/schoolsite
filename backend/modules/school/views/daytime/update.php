<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachDaytime */

$this->title = '更新表项: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '作息表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="teach-daytime-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
