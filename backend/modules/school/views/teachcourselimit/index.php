<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use backend\libary\CommonFunction;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\school\models\TeachcourselimitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '课程数量限制';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row col-md-8">
<div class="box box-success">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <p>
        <?= Html::a('设置课程限制', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            ['attribute'=>'department_id','value'=>'department.title'],
            ['attribute'=>'course_id','value'=>function($model){
                $arr = CommonFunction::getAllSubjects();
                return ArrayHelper::getValue($arr,$model->course_id);
            }],
            'course_limit',
           // 'note',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>
