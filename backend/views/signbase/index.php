<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use backend\libary\CommonFunction;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SignbaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '录取基础数据管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sign-base-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('新建基础数据', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('导入数据', ['import'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('清空基础数据', ['del'], ['class' => 'btn btn-danger pull-right','onclick'=>'return confirm("您确定要删出当前全部基础数据吗？")']) ?>
    </p>
    <div class="box box-primary">

    <!-- /.box-header -->
    <div class="box-body">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'kh',
            'xm',
            'xb',
            'byzx',
            //'bjdm',
            //'csny',
            'lxdh',
            //'txdz',
            //'sfzh',
            //'yw',
            //'sx',
            //'wy',
            //'wl',
            //'hx',
            //'zz',
            //'ls',
            //'sw',
            //'dl',
            //'sy',
            //'ty',
            //'zf',
            'lqzf',
            'lqxx',
            'bmd',
            ['attribute'=>'flag','filter'=>CommonFunction::getLqjd()],
            //'note',

            ['class' => 'yii\grid\ActionColumn',
             'header'=>'操作',
              'template'=>'{view}',
              'contentOptions'=>['width'=>'50px','align'=>'center']
            ],
        ],
    ]); ?>

</div>
</div>
</div>
