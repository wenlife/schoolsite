<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\libary\CommonFunction;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SysnoticeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '系统通知';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-notice-index">

    <p>
        <?= Html::a('创建新通知', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title text-danger"></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute'=>'pos','value'=>function($model){
                 return ArrayHelper::getValue(CommonFunction::getNoticepos(),$model->pos);
            },'filter'=>CommonFunction::getNoticepos()],
            ['attribute'=>'level','value'=>function($model){
                return ArrayHelper::getValue(CommonFunction::getNoticelevel(),$model->level);
            },'filter'=>CommonFunction::getNoticelevel()],
            ['attribute'=>'content','format'=>'html'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    </div>


</div>
