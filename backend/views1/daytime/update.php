<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DayTimeSchedule */

$this->title = 'Update Day Time Schedule: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Day Time Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="day-time-schedule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
