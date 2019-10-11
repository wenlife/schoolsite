<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teachers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">

    <p>
        <?= Html::a('Create Teacher', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'pinx',
            'gender',
            'subject',
            'department',
            //'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
