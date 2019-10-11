<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClasssettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Class Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-setting-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Class Setting', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'department',
            'name',
            'year',
            'sort',
            //'type',
            //'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
