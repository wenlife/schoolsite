<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\school\models\TeachcalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '校历';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-cal-index">
<div class="teach-daytime-index">
<div class="box box-success">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <p>
        <?= Html::a('新建日历', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            ['attribute'=>'grade','value'=>function($model){
                return ArrayHelper::getValue(["1"=>'高一年级',"2"=>'高二年级','3'=>'高三年级','4'=>'全校'],$model->grade);
            }],
            //'grade',
            'start',
            'end',
            //'color',

            ['class' => 'yii\grid\ActionColumn',
             'header'=>'操作',
              'template'=>'{update}&nbsp&nbsp{delete}',
            ],
        ],
    ]); ?>
</div>
</div>
</div>
