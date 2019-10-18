<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachDaytime */

$this->title = 'Update Teach Daytime: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Teach Daytimes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teach-daytime-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
