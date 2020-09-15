<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\libary\CommonFunction;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\guest\models\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '教师管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">
<div class="box box-success">
    <div class="box-header">

    </div>
    <!-- /.box-header -->
    <div class="box-body">
    
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建教师', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('导入教师', ['import'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('重置安全码', ['secode'], ['class' => 'btn btn-success']) ?>
         <?= Html::a('导出安全码', ['exportsecode'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'pinx',
            ['attribute'=>'subject','value'=>function($model){
                $subjects = CommonFunction::getAllTeachDuty();
                return $subjects[$model->subject];
            }],
            ['attribute'=>'type','value'=>function($model){
                $type = CommonFunction::getTeacherType();
                return ArrayHelper::getValue($type,$model->type);
            }],
            'secode',
            'username',
            //'school',
            //'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>
