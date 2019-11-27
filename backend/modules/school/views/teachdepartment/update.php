<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachDepartment */

$this->title = '更新级部信息: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '年级管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="teach-department-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
