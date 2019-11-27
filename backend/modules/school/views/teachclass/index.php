<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\guest\models\TeachClassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '班级管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-class-index">

</div>
<div class="box box-success">
    <div class="box-header">
        <p>
        <?= Html::a('创建新班级', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('批量班级创建', ['factory'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('指标分配', ['/testService/taskline'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
          <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'title',
                'grade',
                ['attribute'=>'department_id','value'=>'department.title'],
                ['attribute'=>'type','value'=>function($model){return $model->type=='lk'?'理科':'文科';}],
                'school',
                //'note',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    <!-- /.box-body -->
  </div>

