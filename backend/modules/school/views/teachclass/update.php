<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\TeachClass */

$this->title = '更新班级信息: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '班级', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="teach-class-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
