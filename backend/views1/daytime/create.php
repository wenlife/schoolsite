<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DayTimeSchedule */

$this->title = 'Create Day Time Schedule';
$this->params['breadcrumbs'][] = ['label' => 'Day Time Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="day-time-schedule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
