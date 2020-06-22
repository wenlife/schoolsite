<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use backend\libary\CommonFunction;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SignsheetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '艺体生报名管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sign-sheet-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('新建报名', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('数据导出', ['export'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="box box-primary">

    <!-- /.box-header -->
    <div class="box-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
            'gender',
            //'old',
            //'idcard',
            //'birth',
            //'graduate',
            ['attribute'=>'cat1','value'=>function($model){
                $arr2 = ['ty'=>'体育','yy'=>'音乐','ms'=>'美术']; 
                return ArrayHelper::getValue($arr2,$model->cat1);
            },'filter'=>['ty'=>'体育','yy'=>'音乐','ms'=>'美术'],
            'filterInputOptions'=>['prompt'=>'请选择','class'=>'form-control','style'=>'width:100px'],
            'contentOptions'=>['width'=>'100px','align'=>'center']
            ],
            'cat2',
            //'cat3',
            //'height',
            //'weight',
            //'photo:ntext',
            //'graduate_id',
            //'prizedetail:ntext',
            ['attribute'=>'score','label'=>'折合成绩'],
            //'parentname',
            //'parentrelation',
            'parentphone',
            ['attribute'=>'verify','format'=>'raw',
             'value'=>function($model){
                $arr = CommonFunction::getVerifyState();
                $label = CommonFunction::getLabel();
                return "<label class='".ArrayHelper::getValue($label,$model->verify)."'>"
                               .ArrayHelper::getValue($arr,$model->verify)."</span>";
            },'filter'=>CommonFunction::getVerifyState(),
              'filterInputOptions'=>['prompt'=>'请选择','class'=>'form-control','style'=>'width:100px'],
            ],
              

            ['class' => 'yii\grid\ActionColumn',
             'header'=>'操作',
              'template'=>'{view}',
              'contentOptions'=>['width'=>'50px','align'=>'center']
            ],
           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
</div>
</div>
