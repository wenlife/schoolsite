<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\school\models\DaytimeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teach Daytimes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-daytime-index">


    <p>
        <?= Html::a('新建作息表项', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'department',
            'sort',
            'part',
            'title',
            'start',
            'end',
            'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
