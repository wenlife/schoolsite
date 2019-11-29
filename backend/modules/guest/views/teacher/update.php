<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\Teacher */

$this->title = '更新教师信息: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '教师', 'url' => ['index']];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="teacher-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
