<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use backend\libary\CommonFunction;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SignkszbmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '新生录取管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sign-kszbm-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('新建报名', ['create'], ['class' => 'btn btn-primary']) ?>
        <?php
        if(Yii::$app->user->can('schoolPost'))
          echo Html::a('数据导出', ['export'], ['class' => 'btn btn-success']);
        ?>
        <?= Html::a('录取查询', ['query'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-primary">

    <!-- /.box-header -->
    <div class="box-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'zk_exam_id',
            'name',
            'gender',
            //'birth_place',
            //'origin_place',
            'minzu',
            //'id_card',
            //'hukou_place',
            //'hukou_type',
            //'height',
            'health',
            //'address',
            //'if_pre_educate',
            //'if_sigle',
            'if_alone',
            //'if_ls',
            
            'zk_score',
            'zk_school',
            //'party_type',
            //'speciality:ntext',
            //'if_live',
            //'if_cload',
            //'if_en',
            //'if_help',
            //'dad_name',
            //'dad_nation',
            //'dad_hukou',
            //'dad_idcard',
            //'dad_phone',
            //'dad_company',
            //'dad_duty',
            //'mom_name',
            //'mom_nation',
            //'mom_hukou',
            //'mom_idcard',
            //'mom_phone',
            //'mom_company',
            //'mom_duty',
            //'if_uniform',
            //'create_time',
            //'update_time',
            //'verify',
            ['attribute'=>'verify','value'=>function($model){
                return ArrayHelper::getValue(CommonFunction::getLqjd(),$model->verify);
            },'filter'=>CommonFunction::getLqjd()],
            //'verify_time',
            //'verify_admin',
            //'verify_msg',
            //'note:ntext',

           // ['class' => 'yii\grid\ActionColumn'],
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
