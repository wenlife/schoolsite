<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DaytimeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Day Time Schedules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="day-time-schedule-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Day Time Schedule', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sort',
            'part',
            'title',
            'start',
            //'end',
            //'grade',
            //'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
