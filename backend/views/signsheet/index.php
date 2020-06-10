<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

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

            'id',
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
            'contentOptions'=>['width'=>'100px']
            ],
            'cat2',
            //'cat3',
            //'height',
            //'weight',
            //'photo:ntext',
            //'graduate_id',
            //'prizedetail:ntext',
            //'score',
            //'parentname',
            //'parentrelation',
            'parentphone',
            ['attribute'=>'verify','value'=>function($model){
                $arr = ['0'=>'未审核','1'=>'已通过','2'=>'未通过'];
                return ArrayHelper::getValue($arr,$model->verify);
            }],

            ['class' => 'yii\grid\ActionColumn',
             'header'=>'操作',
              'template'=>'{view}',
            ],
           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
</div>
</div>
