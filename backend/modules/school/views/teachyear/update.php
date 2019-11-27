<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\TeachYearManage */

$this->title = '更新学年度信息: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '学年度', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="teach-year-manage-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
